# php class macro

```php
class Test{
    use \DeathSatan\Macro\Macro;
}

Test::macro('test',function ($a){
    return $a;
},true);

Test::macro('demo',function ($a){
    return $a;
},false);

var_dump(Test::test(123));//123
var_dump((new Test)->demo(321));//321
```
