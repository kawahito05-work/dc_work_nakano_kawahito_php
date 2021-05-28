<?php
for($i = 1; $i <= 100; $i++){
    if($i % 5 === 0 && $i % 3 === 0){
        print 'FizzBuzz';
    }else if($i % 3 === 0){
        print 'Buss';
    }else if($i % 5 === 0){
        print 'Fizz';
    }else{
        print $i;
    }
    print '<br>';
}
?>