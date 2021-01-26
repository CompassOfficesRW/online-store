<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class OrderStatus extends Enum
{
    const Open =   0;
    const Process =   1;
    const Paid = 2;
    const Packed = 3;
    const Completed = 4;
}
