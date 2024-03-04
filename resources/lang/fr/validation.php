<?php

    return [
        'custom'=>[
            'first_name' => [
                'required' => 'Le champ prénom est obligatoire.',
                'string' => 'Le champ prénom doit être une chaine de carratères',
                'accepted' => 'Le champ prénom doit être accepté.',
                'array' => 'Le champ prénom doit être de type array',
                'min' => [
                    'string'=> 'Le champs prénom doit contenir au moins :min caractès',
                    'array'=> 'Le champs prénom doit contenir au moins :min éléments',
                ]
            ],
        ],
    ]
?>
