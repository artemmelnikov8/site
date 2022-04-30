<?php
namespace MailPoetVendor\Symfony\Component\Validator\Constraints;
if (!defined('ABSPATH')) exit;
use MailPoetVendor\Symfony\Component\Validator\Constraint;
use MailPoetVendor\Symfony\Component\Validator\Exception\InvalidArgumentException;
use MailPoetVendor\Symfony\Component\Validator\Exception\MissingOptionsException;
class Length extends Constraint
{
 public const TOO_SHORT_ERROR = '9ff3fdc4-b214-49db-8718-39c315e33d45';
 public const TOO_LONG_ERROR = 'd94b19cc-114f-4f44-9cc4-4138e80a87b9';
 public const INVALID_CHARACTERS_ERROR = '35e6a710-aa2e-4719-b58e-24b35749b767';
 protected static $errorNames = [self::TOO_SHORT_ERROR => 'TOO_SHORT_ERROR', self::TOO_LONG_ERROR => 'TOO_LONG_ERROR', self::INVALID_CHARACTERS_ERROR => 'INVALID_CHARACTERS_ERROR'];
 public $maxMessage = 'This value is too long. It should have {{ limit }} character or less.|This value is too long. It should have {{ limit }} characters or less.';
 public $minMessage = 'This value is too short. It should have {{ limit }} character or more.|This value is too short. It should have {{ limit }} characters or more.';
 public $exactMessage = 'This value should have exactly {{ limit }} character.|This value should have exactly {{ limit }} characters.';
 public $charsetMessage = 'This value does not match the expected {{ charset }} charset.';
 public $max;
 public $min;
 public $charset = 'UTF-8';
 public $normalizer;
 public $allowEmptyString;
 public function __construct($options = null)
 {
 if (null !== $options && !\is_array($options)) {
 $options = ['min' => $options, 'max' => $options];
 } elseif (\is_array($options) && isset($options['value']) && !isset($options['min']) && !isset($options['max'])) {
 $options['min'] = $options['max'] = $options['value'];
 unset($options['value']);
 }
 parent::__construct($options);
 if (null === $this->min && null === $this->max) {
 throw new MissingOptionsException(\sprintf('Either option "min" or "max" must be given for constraint "%s".', __CLASS__), ['min', 'max']);
 }
 if (null !== $this->normalizer && !\is_callable($this->normalizer)) {
 throw new InvalidArgumentException(\sprintf('The "normalizer" option must be a valid callable ("%s" given).', \is_object($this->normalizer) ? \get_class($this->normalizer) : \gettype($this->normalizer)));
 }
 }
}