<?php
/**
 * @author IvanChe <ivanche.freelancer@gmail.com>
 */

namespace Ivanche\TypeConverterBundle\Exception;


class UnsupportedConverterException extends \Exception
{
    protected $message = 'Unsupported converter. Converter must implements Ivanche\Converter\ConverterInterface.';
}