<?php

declare(strict_types=1);

namespace App;

use Symfony\Component\Serializer\Encoder\JsonEncoder;

class BlueprintParser
{
    protected string $source;
    protected array $decoded = [];
    protected array $result = [];

    public function __construct(string $source)
    {
        $this->source = $source;

        $this->decode();
    }

    public function setBlueString(string $source)
    {
        $this->source = $source;
        $this->decode();
    }

    public static function isValid($source) :bool
    {
        $encoder = new JsonEncoder();

        try {
            $decodedString = $encoder->decode(gzuncompress(base64_decode(mb_substr($source, 1))), JsonEncoder::FORMAT);

            return \is_array($decodedString);
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function summary()
    {
        if($this->getIsBook()) {
            $this->result = $this->bookSummary($this->decoded);
        } else {
            $this->result = $this->blueprintSummary($this->decoded);
        }

        return $this;
    }

    /**
     * Get an array with label and icons.
     * On single blueprint user can pick the icons or it will pick automatically.
     * This is extra icons basically represent the whole recipe.
     * @return array
     */
    public function getBlueprintExtra(): array
    {
        if($this->getIsBook()) {
            return $this->makeBookExtra($this->decoded);
        }

        return $this->makeBlueprintExtra($this->decoded);
    }

    public function getIsBook(): bool
    {
        return isset($this->decoded['blueprint_book']);
    }

    public function decode(): void
    {
        $encoder = new JsonEncoder();

        $this->decoded = $encoder->decode(gzuncompress(base64_decode(mb_substr($this->source, 1))), JsonEncoder::FORMAT);
    }

    /**
     * Count all an items for single blueprint.
     * @param $sourceArray
     * @return array
     */
    private function blueprintSummary(array $sourceArray): array
    {
        $countedItems = [];
        $additionalItems = [];
        if (!empty($sourceArray['blueprint']['entities'])) {
            foreach ($sourceArray['blueprint']['entities'] as $entity) {
                if (isset($countedItems[$entity['name']])) {
                    ++$countedItems[$entity['name']];
                } else {
                    $countedItems[$entity['name']] = 1;
                }

                if (isset($entity['items'])) {
                    foreach ($entity['items'] as $key => $val) {

                        if(\is_array($val)) {
                            if (isset($additionalItems[$val['item']])) {
                                $additionalItems[$val['item']] += $val['count'];
                            } else {
                                $additionalItems[$val['item']] = $val['count'];
                            }
                        } elseif(\is_numeric($val)) {
                            if (isset($additionalItems[$key])) {
                                $additionalItems[$key] += $val;
                            } else {
                                $additionalItems[$key] = $val;
                            }
                        }

                    }
                }
            }
        }

        return array_merge($countedItems, $additionalItems);
    }

    private function makeBlueprintExtra($sourceArray): array
    {
        $extra = [
            'icons' => [],
            'label' => '',
        ];

        if (!empty($sourceArray['blueprint']['icons'])) {
            $icons = [];

            foreach ($sourceArray['blueprint']['icons'] as $icon) {
                $icons[] = $icon['signal']['name'];
            }
            $extra['icons'] = (new JsonEncoder())->encode($icons, JsonEncoder::FORMAT);
        }

        if (!empty($sourceArray['blueprint']['label'])) {
            $extra['label'] = $sourceArray['blueprint']['label'];
        }

        return $extra;
    }

    private function bookSummary(array $sourceArray): array
    {
        $items = [];
        foreach ($sourceArray['blueprint_book']['blueprints'] as $row) {
            $icons = [];

            foreach ($row['blueprint']['icons'] as $icon) {
                $icons[] = $icon['signal']['name'];
            }
            $items[] = [
                'label' => $row['blueprint']['label']??'',
                'icons' => $icons,
            ];
        }

        return $items;
    }

    private function makeBookExtra($sourceArray): array
    {
        return [
            'label' => $sourceArray['blueprint_book']['label'],
            'icons' => null
        ];
    }

    public function asArray(): array
    {
        return $this->result;
    }

    public function asJson(): string
    {
        return (new JsonEncoder())->encode($this->result, JsonEncoder::FORMAT);
    }
}