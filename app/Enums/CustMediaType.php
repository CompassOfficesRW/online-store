<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class CustMediaType extends Enum
{
    const Whatsapp =   0;
    const Carousell =   1;
    const Facebook = 2;
}
