<?php declare(strict_types = 1);

namespace FP_Interview\tests;

use FP_Interview\UIDGenerator;
use PHPUnit\Framework\TestCase;

final class UIDGeneratorTest extends TestCase
{

    public function testUniqueInNanoSeconds(): void
    {
        $uid_generator = new UIDGenerator;
        $n1 = $uid_generator->rn();
        time_nanosleep(0, 1);
        $n2 = $uid_generator->rn();
        $this->assertNotEquals(
            $n1,
            $n2,
        );
    }

}