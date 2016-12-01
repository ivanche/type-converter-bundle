#Symfony Type Converter Bundle

This bundle is built to inject a library [type converter](https://github.com/ivanche/type-converter).

#Installation

Use composer to intall this bundle
```Shell
composer require ivanche/type-converter-bundle
```
 
#Configuration
It have a few options.
```YAML
ivanche_type_converter:
    auto_mapping: false
    strict: true
```

###Options:
####auto\_mapping: boolean (_true_|_false_)<br>
If the converter implements `Ivanche\Converter\AutoMappingInterface`, we add methodCall `setAutoMapping` to definition of your converter.

If `auto_mapping` is true, converter try to set public properties(or properties with public getter/setter) to _target_ 
from _source_.

####strict: boolean (_true_|_false_)<br>
If the converter implements `Ivanche\Converter\AutoMappingInterface`, we add methodCall `setStrictMode` to definition of your converter.

When `strict` is true, converter throw exception `Ivanche\Exception\UnsupportedSourcePropertyException` if automapping try to set public properties(or properties with public getter/setter) from _source_ which don't exist in _target_.