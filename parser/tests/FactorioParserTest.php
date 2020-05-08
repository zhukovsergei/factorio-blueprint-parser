<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class FactorioParserTest extends TestCase
{
//    private string $correctBlueString;

/*    public function setUp() :void
    {
        $this->correctBlueString = '0eNrtXN1u2zYUfpVAl5tViD+SZaPb1ba7Al1boMCGwpBtJiFqS55EZwsKP8AeZC+2JxklxbIsk+KhIsXO4Fw0tX4+HZ2PPOfwfHS+OfPVlm1SHovZPEm+OtNvhyOZM';
    }*/


    public function testValidBlueprint(): void
    {
        $correctBlueString = '0eNqllt1u4yAQhd+FayMF8E/jV6mqFSGjBBWDBXjTKPK7F8dda9tSZ6xeWbbhO4cZZuBGDmaA3msbSXsjWjkbSPt8I0GfrDTTt3jtgbRER+hIQazspjcZAnQHo+2JdlKdtQXKyFgQbY/wRlo2vhQEbNRRw8y7v1z/2KE7gE8DFlLopDEUDKjotaK9M5BkehfSXGcnA4lHm4Jc06Mcx+Ibiy+si3NHsFSdIcQMpF6BiAWibQAf07cfAVUOUGIA1QqgWg/ud1g5w0QKuwel5yx5Z+kJpKeXM4AhGZ160RlSsvzJu/SkBzC5kPF/ISvIUSeV+V9S/tgVboj9EHMyzSITvbShdz4+EBFfRDLQp81Q/hi6x2TuI9gslzm2w9uaObvPrngOyjavlT1eK+MbC0+srVtstYhZd4mHCjS0QkN3aGaNN8rQUHzZ4COKrxq8zz2aid7xHF9G6MRzfBVVaCbHNIw5Pdm64WJrq5/z8qnTyyG6Tk6DaFAarALaS/Waa8Ucczat+d16NPHf2a03ylW/k2u2tcRyJVBPiEBXK/P3X6wY2fU/HiJinG5Z93tZ+981riB/wYf76Ebs2L7mTDT1OL4DxDNM2g==';
        $this->assertTrue(\App\BlueprintParser::isValid($correctBlueString));

        $incorrectBlueString = 'incorrectBlueString';
        $this->assertFalse(\App\BlueprintParser::isValid($incorrectBlueString));
    }

    public function testIsBook(): void
    {
        $singleRecipe = '0eNqllt1u4yAQhd+FayMF8E/jV6mqFSGjBBWDBXjTKPK7F8dda9tSZ6xeWbbhO4cZZuBGDmaA3msbSXsjWjkbSPt8I0GfrDTTt3jtgbRER+hIQazspjcZAnQHo+2JdlKdtQXKyFgQbY/wRlo2vhQEbNRRw8y7v1z/2KE7gE8DFlLopDEUDKjotaK9M5BkehfSXGcnA4lHm4Jc06Mcx+Ibiy+si3NHsFSdIcQMpF6BiAWibQAf07cfAVUOUGIA1QqgWg/ud1g5w0QKuwel5yx5Z+kJpKeXM4AhGZ160RlSsvzJu/SkBzC5kPF/ISvIUSeV+V9S/tgVboj9EHMyzSITvbShdz4+EBFfRDLQp81Q/hi6x2TuI9gslzm2w9uaObvPrngOyjavlT1eK+MbC0+srVtstYhZd4mHCjS0QkN3aGaNN8rQUHzZ4COKrxq8zz2aid7xHF9G6MRzfBVVaCbHNIw5Pdm64WJrq5/z8qnTyyG6Tk6DaFAarALaS/Waa8Ucczat+d16NPHf2a03ylW/k2u2tcRyJVBPiEBXK/P3X6wY2fU/HiJinG5Z93tZ+981riB/wYf76Ebs2L7mTDT1OL4DxDNM2g==';
        $bpp = new \App\BlueprintParser($singleRecipe);
        $this->assertFalse($bpp->getIsBook());

        $aBook = '0eNq9mO2OqjAQQN+lvyGBfoD6Kjc3pmKjzUJLStm9ZsO7XxBXd7ULM5jdXwakZ6YtMz36TnZlq2qnjd/urH0hm/fbnYZs/ny6HL7ThTXj7UYfjCyHe/5UK7Ih2quKRMTIariSTaOqXanNIa5kcdRGxSnpIqLNXv0jm7T7GxFlvPZajbzzxWlr2mqnXP/AldRUsixjVarCO13EtS1VH6a2TT/WmiGBnhfnETn1H7zrogcWvbLerN0rExdH1fgAJJuAsCtEm0Y539/7FiBCAA4BiAmAmF7cRxgfYaxfdqcKPe6SsyY+KOnit6NSJQnEya5x2n6z3MHZ/jPeqTK0ZPRjySKy132U8bs+8uWtsK2vWx8Kk1/DeCdNU1vnZ4KwuyAB6AoNpfPQNWTnLoudhnYuTeBpjZzka1Y0BE3Rc03n55pSZOGxqXkzbIqQeXM4lIGhAgxNwMwMnmgKhsLLBr6i8KqB57kGM8FvPIWXEXjjKbyKBJhJIQ1j3J5g3VCGbfXjvnzp9LL1tpLDQ3FTaGUKFdeyeAm1Ygo5m6byxR5N9Ll0M2Q48Vy4HNcS+cRCrQALLSbGr+9SKWVVf3uIsG6wrLOXbT5pXERelWvOT+csSdcZTVme3dwsGQL/kPVFs4i7KrwNpnBlhGmemHZFnGRxpGSxBZIl8JLF0Y7A5x1B/IS5ZQjJot1zPsmDOkR/3ydRikWfVUsKnjbGLRmcSpGSBYIyrGWBqBypWSCoQHoWCJohRQsEzZGmBYKukKoFgq7hrpV001KJci261CZSsGuF86WLXGtxumyRa9HnTRThWsmMlM65Vnh8hnGtYHPGmuPlPeWL1fHybvIZd4R1XzFffSzBNl8IFFIhExNlFNm7ITkxZOuGMDmyc0OYAtm4IcwM9xazia3JwTUZHg8/QjLw9NbIY+mBueRHVhoaFZ//go+I7NGvavvxe+wbVvcfpvrmRQ==';
        $bpp->setBlueString($aBook);
        $this->assertTrue($bpp->getIsBook());
    }

    public function testBookSummary(): void
    {
        $expect = [
            [
                'label' => '',
                'icons' =>
                    [
                        'beacon',
                        'roboport',
                    ],
            ],
            [
                'label' => 'Example 1',
                'icons' =>
                    [
                        'assembling-machine-1',
                    ],
            ],
        ];

        $aBook = '0eNqlll2P4iAUhv/KhmuZlNaPHbNXm+yv2EwaWo9KlgIBajQT//seqlZHqW2dqwqU53zw8tpPUsgajBXK54XW/8jy8zrjyPLvzTCsiVKr07QTG8VlmPMHA2RJhIeKTIjiVRgVwPFVcpwQoVawJ0t2nPRusrrQRlt/sy09fkwIKC+8gFPgZnDIVV0VYJHb7gYJpbeipOvaKl4Cco12uBHzwIgIo9MJOYRH4GNkF+aN1au69GKHVFrhbwk0C4FDwnfB0jHB2DeDZY99eQiSvs1OUbK3WYwxbRlr7jwVyoH1uNDZmhSzXQmLxTVr0whzNpjJBjPn18bujQXnqLdcuVA0LUBGKqfnwtlXeBqBL+5V+QjLGhi7PSpnAFZ9Z/RzfN7TwXm/j4dng+Es6e1K8mJTGBufeDo88XQ8nV3oMV7W24hX1cGu168QG9p6htEyZhjZ+TJPw13+OAULW1sDnpAdWNfsWGQJe5+nLFvMr2aZhBxe82vuHFSFFGpDK15uhQLKvrj3YBsWVitabsH5LkXRDMEFDxb31GO7nSW5GMtT24zW1CUO7B1B3QnTGluNpduN1fg86eo7/soG63s2Wt5pW8Bol32osQN+nzjWfZaRrr2po71ZDO1N3LTmT+3WVVxKKnllOk80qo73cQc2zkj7BBv+CPFCeqtlXsCW74S24YVS2LIWPse1VbtrLazzec+17RJqCOM8DyYwS8KoMtxyH8KRX+Q40LWHqqNTHEJ1aOPGxAeJ40EbcXuUHNPEuT97FIaEH6zXMlmMRJtP4SvuNw4bFg+fbpBf7LYDfvwPHXjIDg==';
        $bpp = new \App\BlueprintParser($aBook);
        $parsed = $bpp->summary()->asArray();
        $this->assertEquals($expect, $parsed);

        $expect = '[{"label":"","icons":["beacon","roboport"]},{"label":"Example 1","icons":["assembling-machine-1"]}]';
        $parsed = $bpp->summary()->asJson();
        $this->assertEquals($expect, $parsed);
    }

    public function testSingleSummary(): void
    {
        $expect = [
            'electric-furnace' => 2,
            'roboport' => 1,
            'fast-inserter' => 2,
            'express-transport-belt' => 5,
            'beacon' => 3,
            'big-electric-pole' => 1,
            'productivity-module-3' => 4,
            'speed-module-3' => 6,
        ];

        $blueprint = '0eNqllNuOgjAQht9lrqmxLejKq2zMhsNomkDbtMVoDO++LbjoKhvAvaIH5vv/mbZzhbxqUBshHaRXEIWSFtLPK1hxlFkV1txFI6QgHNYQgczqMMsx879CG4GQJZ4hpW00GWRUrrQy7iGMtfsIUDrhBPbC3eTyJZs6R+O5QzRWWDgjCnJojMwK9FytrA/0Pryih5E4gkv4BL5XtmFdG1U2hRMnTyW1H1dIeBAOhp/E2BIx+k8x/lqXFxG2SnoVvkrGGPHAOGTWESEtGuc3/iwN825LYXxy3V48wkxmM+ls5uZe2LM2aC1xJpM2JE1yrEYyJ7fE6W84G4Fvn2/lK4x3MPp4VFYjllNn9LHcdzzb9245nM+G0/VkVdZvFoXS5cbZfONsOZ3+0Md4fLIQ794Oen9+uTiSoWdoVY01DH57zHF4y/teLIQODTiCExrbRWz5mu42jPLtpm2/ARxU4FE=';
        $bpp = new \App\BlueprintParser($blueprint);
        $parsed = $bpp->summary()->asArray();
        $this->assertEquals($expect, $parsed);

        $expect = '{"electric-furnace":2,"roboport":1,"fast-inserter":2,"express-transport-belt":5,"beacon":3,"big-electric-pole":1,"productivity-module-3":4,"speed-module-3":6}';
        $parsed = $bpp->summary()->asJson();
        $this->assertEquals($expect, $parsed);
    }

    public function testBookExtra(): void
    {
        $expect = [
            'label' => 'Book 1',
            'icons' => null
        ];

        $aBook = '0eNqlll2P4iAUhv/KhmuZlNaPHbNXm+yv2EwaWo9KlgIBajQT//seqlZHqW2dqwqU53zw8tpPUsgajBXK54XW/8jy8zrjyPLvzTCsiVKr07QTG8VlmPMHA2RJhIeKTIjiVRgVwPFVcpwQoVawJ0t2nPRusrrQRlt/sy09fkwIKC+8gFPgZnDIVV0VYJHb7gYJpbeipOvaKl4Cco12uBHzwIgIo9MJOYRH4GNkF+aN1au69GKHVFrhbwk0C4FDwnfB0jHB2DeDZY99eQiSvs1OUbK3WYwxbRlr7jwVyoH1uNDZmhSzXQmLxTVr0whzNpjJBjPn18bujQXnqLdcuVA0LUBGKqfnwtlXeBqBL+5V+QjLGhi7PSpnAFZ9Z/RzfN7TwXm/j4dng+Es6e1K8mJTGBufeDo88XQ8nV3oMV7W24hX1cGu168QG9p6htEyZhjZ+TJPw13+OAULW1sDnpAdWNfsWGQJe5+nLFvMr2aZhBxe82vuHFSFFGpDK15uhQLKvrj3YBsWVitabsH5LkXRDMEFDxb31GO7nSW5GMtT24zW1CUO7B1B3QnTGluNpduN1fg86eo7/soG63s2Wt5pW8Bol32osQN+nzjWfZaRrr2po71ZDO1N3LTmT+3WVVxKKnllOk80qo73cQc2zkj7BBv+CPFCeqtlXsCW74S24YVS2LIWPse1VbtrLazzec+17RJqCOM8DyYwS8KoMtxyH8KRX+Q40LWHqqNTHEJ1aOPGxAeJ40EbcXuUHNPEuT97FIaEH6zXMlmMRJtP4SvuNw4bFg+fbpBf7LYDfvwPHXjIDg==';
        $bpp = new \App\BlueprintParser($aBook);
        $parsed = $bpp->getBlueprintExtra();
        $this->assertEquals($expect, $parsed);
    }

    public function testSingleExtra(): void
    {
        $expect = [
            'icons' => '["beacon","roboport"]',
            'label' => 'Some label here',
        ];

        $blueprint = '0eNqllNuOwiAQhl/FzHUxAlXXvsZebsymh9ElaYEANRrTd1+obnW1m7buVTl0vv+fAeYMWVmjNkI6SM4gciUtJB9nsGIv0zKsuZNGSEA4rCACmVZhlmHqf4UmAiELPEJCm2gwyKhMaWXcXRhrthGgdMIJvAi3k9OnrKsMjed20Vhi7ozIya42Ms3Rc7WyPtD78IoeRuIITuET+F7ZhnVtVFHnThw8lVR+XCLhQTgYfhBjU8ToP8X4c12eRNh8eVHh82UfI+4Yu9Q6IqRF4/zGn6Vh3m0hjE+u3Yt7mMvRTDqauboV9qgNWkucSaUNSZMMy57MyTVx+hvOeuDrx1v5DOMtjN4fldWIxdAZvU33HY/2vZkO56PhdDFYlcWLRaF0unE23jibTqc/9D4eHyzEq7eD3p5fJvak6xlalX0Ng18fcxze8vYiFkK7BhxBmfoM/dq7qnDWTmZfaALsgMa2rDVf0M2KUb5eNc03aYXotw==';
        $bpp = new \App\BlueprintParser($blueprint);
        $parsed = $bpp->getBlueprintExtra();

        $this->assertEquals($expect, $parsed);
    }

}