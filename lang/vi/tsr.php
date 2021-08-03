<?php

return [
    'telco' => [
        'VTT' => [ 'available' => true, 'title' => 'Viettel Card', 'need_dvalue' => true,
            'supported_values' => [50000 => '50k', 100000 => '100k', 200000 => '200k', 300000 => '300k', 500000 => '500k']],
        'VNP' => [ 'available' => true, 'title' => 'Vinaphone Card', 'need_dvalue' => true,
            'supported_values' => [20000 => '20k', 30000 => '30k', 50000 => '50k', 100000 => '100k', 200000 => '200k', 300000 => '300k', 500000 => '500k']],
        'VMS' => [ 'available' => false, 'title' => 'Mobifone Card', 'need_dvalue' => true,
            'supported_values' => [50000 => '50k', 100000 => '100k', 200000 => '200k', 300000 => '300k', 500000 => '500k']],
        'GATE' => [ 'available' => true, 'title' => 'FPT GATE', 'need_dvalue' => true,
            'supported_values' => [10000 => '10k', 20000 => '20k', 30000 => '30k', 50000 => '50k',
                100000 => '100k', 200000 => '200k', 300000 => '300k', 500000 => '500k', 1000000 => '1000k']],
        'VNG' => [ 'available' => true, 'title' => 'Zing Card', 'need_dvalue' => true,
            'supported_values' => [10000 => '10k', 20000 => '20k', 30000 => '30k', 50000 => '50k',
                100000 => '100k', 200000 => '200k', 300000 => '300k', 500000 => '500k', 1000000 => '1000k']],
        //'MOMO' => [ 'available' => false, 'title' => 'Ví Momo', 'need_dvalue' => false ],
    ],
    'telco_static' => [
        'VTT' => 'Thẻ Viettel',
        'VNP' => 'Thẻ Vinaphone',
        'VMS' => 'Thẻ Mobifone',
        'GATE' => 'Thẻ FPT GATE',
        'VNG' => 'Thẻ Vinagame',
    ],
    'values_static' => [50000 => '50k', 100000 => '100k', 200000 => '200k', 300000 => '300k', 500000 => '500k'],
    'messages' => [
        99 => 'Thẻ trễ, vui lòng đợi thêm vài phút!',
        1 => 'Thẻ đúng',
        2 => 'Thẻ đúng',
        3 => 'Thẻ sai',
        4 => 'Dịch vụ gạch thẻ bảo trì, vui lòng thử lại sau',
        324 => 'Dịch vụ gạch thẻ bảo trì, vui lòng thử lại sau',
        309 => 'Thẻ sai',
        311 => 'Thẻ sai',
        307 => 'Thẻ đã gửi lên trước đó',
        327 => 'Dịch vụ gạch thẻ bảo trì, vui lòng thử lại sau',
        317 => 'Dịch vụ gạch thẻ bảo trì, vui lòng thử lại sau',
        329 => 'Dịch vụ gạch thẻ bảo trì, vui lòng thử lại sau',
        100 => 'Sai mã thẻ'
    ]
];