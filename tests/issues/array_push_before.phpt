--TEST--
Multiple calls to array_push() with before advice
--FILE--
<?php 

aop_add_before('array_push()', 'beforeSystemCall');
function beforeSystemCall (AopJoinPoint $joinpoint) {
    //with and without calling $joinpoint->getArguments() is also causing some variation
    $arguments = $joinpoint->getArguments();
}
$a = array("apple", "orange");
array_push($a, "banana");
array_push($a, "mango");
var_dump($a);
?>
--EXPECT--
array(4) {
  [0]=>
  string(5) "apple"
  [1]=>
  string(6) "orange"
  [2]=>
  string(6) "banana"
  [3]=>
  string(5) "mango"
}
