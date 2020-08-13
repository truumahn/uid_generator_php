<?php declare(strict_types = 1);

namespace FP_Interview;

/**
 * Class UIDGenerator
 */
final class UIDGenerator {

  private const BYTE_LIMIT = 32;

  private const MAX = 1112064;

  private const MIN = 0;

  /**
   * UTF-8 well-formed only characters map.
   *
   * @var array<int>
   */
  private $chr_map;

  /**
   * UIDGenerator constructor.
   */
  public function __construct() {
    $this->chr_map = $chr_map = [
      1 => [hexdec('00'), hexdec('7F')],
      2 => [
        [hexdec('C2'), hexdec('DF')],
        [hexdec('80'), hexdec('BF')],
      ],
      3 => [
        0 => [
          hexdec('E0'),
          [hexdec('A0'), hexdec('BF')],
          [hexdec('80'), hexdec('BF')],
        ],
        1 => [
          [hexdec('E1'), hexdec('EC')],
          [hexdec('80'), hexdec('BF')],
          [hexdec('80'), hexdec('BF')],
        ],
        2 => [
          hexdec('ED'),
          [hexdec('80'), hexdec('9F')],
          [hexdec('80'), hexdec('BF')],
        ],
        3 => [
          [hexdec('EE'), hexdec('EF')],
          [hexdec('80'), hexdec('BF')],
          [hexdec('80'), hexdec('BF')],
        ],
      ],
      4 => [
        0 => [
          hexdec('F0'),
          [hexdec('90'), hexdec('BF')],
          [hexdec('80'), hexdec('BF')],
          [hexdec('80'), hexdec('BF')],
        ],
        1 => [
          [hexdec('F1'), hexdec('F3')],
          [hexdec('80'), hexdec('BF')],
          [hexdec('80'), hexdec('BF')],
          [hexdec('80'), hexdec('BF')],
        ],
        2 => [
          hexdec('F4'),
          [hexdec('80'), hexdec('8F')],
          [hexdec('80'), hexdec('BF')],
          [hexdec('80'), hexdec('BF')],
        ],
      ],
    ];
  }

  /**
   * Generate a random number with a linear congruential generator algorithm.
   */
  public function rn(): int {
    return (1103515245 * microtime(TRUE) + 12345) % (1 << 31);
  }

  /**
   * Generate a random number between the given range.
   *
   * @param int $max
   * @param int $min
   *
   * @return void
   */
  public function rn_range($max, $min = 1): int {
    try {
      if ($max <= 0) {
        throw new \Exception('Number must be greater than zero.');
      }

      return (self::rn() % ($max - $min + 1) + $min);
    }
    catch (\Throwable $e) {
      var_dump($e->getMessage());
    }
  }

  /**
   * Generate a random 32byte id.
   *
   * @return string
   */
  public function getId() {
    $id = '';

    while (strlen($id) !== self::BYTE_LIMIT) {

      $rn = $this->rn_range(self::MAX, self::MIN);
      $char = $this->utf_char($rn);

      if (strlen($id) + strlen($char) > self::BYTE_LIMIT) {
        continue;
      }

      $id .= $char;
    }

    return $id;
  }

  /**
   * Return the UTF-8 character encoded from a corresponding HTML entity.
   *
   * @param int $n
   *
   * @return string
   */
  private function utf_char(int $n): string {
    return mb_convert_encoding("&#{$n};", 'UTF-8', 'HTML-ENTITIES');
  }

}