<?
/*
PHP script getPairsLetters
Version: 1.0, 2023-12-22
Author: Vladimir Kheifets (vladimir.kheifets@online.de)
Copyright (c) 2023 Vladimir Kheifets All Rights Reserved

The script provides a solution to one task of the GCHQ 2023 Christmas competition.
(GCHQ - UK's intelligence, security and cyber agency)

Find the pairs of letters which come next in sequence:
WU, SQ, OM, ??
*/

$str = "WU,SQ,OM";
echo "Find the pairs of letters which come <br>next in sequence:
<b>$str,??</b><hr>";
$pairLetters = explode(",",$str);
$lettersAlpha = explode(",","A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z");
$lettersAlphaCode = array_flip($lettersAlpha);

$lettersToCode = [];
$codeKey = [];
foreach($pairLetters as $i => $pairLetter){
    foreach(str_split($pairLetter) as $j => $letter)
    {
        $lettersToCode[$i][$j] = $lettersAlphaCode[$letter];
        if($i>0)
        {
            $codeKey[] = $lettersToCode[$i][$j] - $lettersToCode[$i-1][$j];
        }
    }
}
$codeKey = array_unique($codeKey);
if(count($codeKey) == 1)
{
    echo <<<EOF
    <b>Сrack of the Caesar's Cipher</b><br><br>
    Key of the cipher:  {$codeKey[0]}<br><br>
    Next pair of letters after:<br>
    EOF;
    foreach($pairLetters as $pairLetter)
    {
        $tmp = str_split($pairLetter);
        $nextPairLetter = "";
        $pairLetterCode="";
        foreach(str_split($pairLetter) as $letter)
        {
            $nextCode = $lettersAlphaCode[$letter] + $codeKey[0];
            $nextPairLetter .= $lettersAlpha[$nextCode];
            $pairLetterCode .= $lettersAlphaCode[$letter];
        }
        echo "$pairLetter is $nextPairLetter<br>";
    }
    echo "<hr>Next pair of letters after $str, is  $nextPairLetter";
}
else
    echo "Key of the Caesar's Cipher not found. Encoding method is not defined";
/*
Find the pairs of letters which come
next in sequence: WU,SQ,OM,??

Сrack of the Caesar's Cipher

Key of the cipher: -4

Next pair of letters after:
WU is SQ
SQ is OM
OM is KI

Next pair of letters after WU,SQ,OM, is KI
*/
?>