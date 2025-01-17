<?php

return [
    'uri' => 'https://thesieure.com/chargingws/v2',
    'penalty' => 50,
    'telco' => [
        'VIETTEL' => [ 'available' => true, 'title' => 'Viettel Card', 'need_dvalue' => true,
            'supported_values' => [50000 => '50k', 100000 => '100k', 200000 => '200k', 300000 => '300k', 500000 => '500k']],
        'VINAPHONE' => [ 'available' => true, 'title' => 'Vinaphone Card', 'need_dvalue' => true,
            'supported_values' => [20000 => '20k', 30000 => '30k', 50000 => '50k', 100000 => '100k', 200000 => '200k', 300000 => '300k', 500000 => '500k']],
        'MOBIFONE' => [ 'available' => false, 'title' => 'Mobifone Card', 'need_dvalue' => true,
            'supported_values' => [50000 => '50k', 100000 => '100k', 200000 => '200k', 300000 => '300k', 500000 => '500k']],
        'VNMOBI' => [ 'available' => false, 'title' => 'Mobifone Card', 'need_dvalue' => true,
            'supported_values' => [50000 => '50k', 100000 => '100k', 200000 => '200k', 300000 => '300k', 500000 => '500k']],
        'GATE' => [ 'available' => true, 'title' => 'FPT GATE', 'need_dvalue' => true,
            'supported_values' => [10000 => '10k', 20000 => '20k', 30000 => '30k', 50000 => '50k',
                100000 => '100k', 200000 => '200k', 300000 => '300k', 500000 => '500k', 1000000 => '1000k']],
        'ZING' => [ 'available' => true, 'title' => 'Zing Card', 'need_dvalue' => true,
            'supported_values' => [10000 => '10k', 20000 => '20k', 30000 => '30k', 50000 => '50k',
                100000 => '100k', 200000 => '200k', 300000 => '300k', 500000 => '500k', 1000000 => '1000k']],
    ],
    'telco_static' => [
        'VIETTEL' => 'Thẻ Viettel',
        'VINAPHONE' => 'Thẻ Vinaphone',
        'MOBIFONE' => 'Thẻ Mobifone',
        'VNMOBI' => 'Thẻ Vietnammobi',
        'ZING' => 'Thẻ VNG Zing',
        'GARENA' => 'Thẻ Garena',
        'GATE' => 'Thẻ FPT Gate',
        'Vcoin' => 'Thẻ VTC Vcoin',
    ],
    'values_static' => [10000 => '10k', 20000 => '20k', 30000 => '30k', 50000 => '50k', 100000 => '100k', 200000 => '200k', 300000 => '300k'],
    'values_dynamic' => [
        'VIETTEL' => [50000 => '50k', 100000 => '100k', 200000 => '200k'],
        'VINAPHONE' => [50000 => '50k', 100000 => '100k', 200000 => '200k', 300000 => '300k'],
        'ZING' => [10000 => '10k', 20000 => '20k', 30000 => '30k', 50000 => '50k', 100000 => '100k', 200000 => '200k', 300000 => '300k', 500000 => '500k', 1000000 => '1000k'],
        'Vcoin' => [10000 => '10k', 20000 => '20k', 30000 => '30k', 50000 => '50k', 100000 => '100k', 200000 => '200k', 300000 => '300k', 500000 => '500k', 1000000 => '1000k']
    ],
];