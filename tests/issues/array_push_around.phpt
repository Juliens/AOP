--TEST--
Multiple calls to array_push() with around advice
--FILE--
<?php 

aop_add_around('array_push()', 'aroundSystemCall');
function aroundSystemCall (AopJoinPoint $joinpoint) {
    $joinpoint->process();
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

