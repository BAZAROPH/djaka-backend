<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Djaka - Consultation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-r from-primary" style="font-family: 'Montserrat', sans-serif;">

    <div class="mx-auto max-w-sm py-8">
        <img src="{{asset('assets/brand/logo.png')}}" class="h-16 mx-auto" alt="">
    </div>

    <div class="bg-white p-5 max-w-3xl mx-auto rounded-lg text-primary">
        <h3 class="font-bold text-lg">Informations personelles</h3>
        <div class="grid md:grid-cols-2 mt-5 text-base gap-3">
            <div>
                <span class="text-sm md:text-base">Nom :</span>
                <span class="text-black pl-4 text-sm md:text-base">{{ $user->last_name }}</span>
            </div>
            <div>
                <span class="text-sm md:text-base">Prénom :</span>
                <span class="text-black pl-4 text-sm md:text-base">{{ $user->first_name }}</span>
            </div>
            <div>
                <span class="text-sm md:text-base">Contact :</span>
                <span class="text-black pl-4 text-sm md:text-base">{{ $user->area_code }} {{ $user->phone_number }}</span>
            </div>
            <div>
                <span class="text-sm md:text-base">Pays de résidence :</span>
                <span class="text-black pl-4 text-sm md:text-base">{{ $user->Country->name }}</span>
            </div>
            <div>
                <span class="text-sm md:text-base">Ville de résidence :</span>
                <span class="text-black pl-4 text-sm md:text-base">{{ $user->City->name }}</span>
            </div>
            <div>
                <span class="text-sm md:text-base">Commune de résidence :</span>
                <span class="text-black pl-4 text-sm md:text-base">{{ $user->Town->name }}</span>
            </div>
            <div>
                <span class="text-sm md:text-base">Quartier de résidence :</span>
                <span class="text-black pl-4 text-sm md:text-base">{{ $user->district }}</span>
            </div>
        </div>
    </div>

    <div class="bg-white p-5 max-w-3xl mx-auto rounded-lg text-primary mt-5 mb-3">
        <h3 class="font-bold text-lg">Informations médicales <span class="font-light text-base md:pl-4 text-black text-xs md:text-base">(mise à jour, {{$medical_informations->updated_at->diffForHumans()}})</span></h3>
        <div class="grid md:grid-cols-2 mt-5 text-base gap-4">
            <div>
                <span class="">Groupe Sanguin :</span>
                <span class="text-red-500 pl-4 font-bold">{{ $medical_informations->blood_type }}</span>
            </div>
            <div>
                <span class="">Taille :</span>
                <span class="text-black pl-4 text-sm md:text-base">{{ $medical_informations->size }} cm</span>
            </div>
            <div>
                <span class="">Poids :</span>
                <span class="text-black pl-4 text-sm md:text-base">{{ $medical_informations->weight }} kg</span>
            </div>
            <div>
                <span class="">Age :</span>
                <span class="text-black pl-4 text-sm md:text-base">{{ $user->birth_date }} an(s)</span>
            </div>

            <hr class="col-span-2">

            <div class="col-span-2 flex flez-wrap items-start gap-3">
                <span class="w-1/8 text-sm md:text-base">Allergies :</span>
                <div class="flex flex-wrap gap-2">
                    @foreach ($medical_informations->allergies as $allergie )
                        @if ($allergie->hidden === false)
                            <span class="text-sm text-green-800 bg-green-500/[0.2] px-2 py-1 rounded-lg">{{$allergie->value}}</span>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="col-span-2 flex flez-wrap items-start gap-3">
                <span class="w-1/8 text-sm md:text-base">Problèmes de santé :</span>
                <div class="flex flex-wrap gap-2">
                    @foreach ($medical_informations->health_problems as $problem )
                        @if ($problem->hidde === false)
                            <span class="text-sm text-red-800 bg-red-500/[0.2] px-2 py-1 rounded-lg">{{$problem->label}}</span>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="col-span-2 flex flez-wrap items-start gap-3">
                <span class="w-1/8 text-sm md:text-base">Médications actuelles :</span>
                <div class="flex flex-wrap gap-2">
                    @foreach ($medical_informations->medications as $medication )
                        @if ($medication->hidden === false)
                            <span class="text-sm text-secondary bg-secondary/[0.2] px-2 py-1 rounded-lg">{{$medication->value}}</span>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="col-span-2 flex flez-wrap items-start gap-3">
                <span class="w-1/8 text-sm md:text-base">3 dernières maladies :</span>
                <div class="flex flex-wrap gap-2">
                    @foreach ($medical_informations->diseases as $disease )
                        @if ($disease->hidden === false)
                         <span class="text-sm text-red-800 bg-red-500/[0.2] px-2 py-1 rounded-lg">{{$disease->value}}</span>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="col-span-2 flex flez-wrap items-start gap-3">
                <span class="w-1/8 text-sm md:text-base">3 dernièrs vaccins :</span>
                <div class="flex flex-wrap gap-2">
                    @foreach ($medical_informations->vaccines as $vaccin )
                        @if ($vaccin->hidden === false)
                         <span class="text-sm text-green-800 bg-green-500/[0.2] px-2 py-1 rounded-lg">{{$vaccin->value}}</span>
                        @endif
                    @endforeach
                </div>
            </div>

            <hr class="col-span-2">

            <h3 class="font-bold text-lg col-span-2">Médecin traitant <span class="font-light text-base md:pl-4 text-black text-xs md:text-base">(mise à jour, {{$medical_informations->updated_at->diffForHumans()}})</span></h3>
            <div>
                <span class="text-sm md:text-base">Nom :</span>
                <span class="text-black pl-4 text-sm md:text-base">
                    @if ($medical_informations->referring_doctor->hidden === false)
                        {{ $medical_informations->referring_doctor->name }}</span>
                    @endif
            </div>
            <div>
                <span class="text-sm md:text-base">Contact :</span>
                <span class="text-black pl-4 text-sm md:text-base">
                    @if (isset($medical_informations->referring_doctor_contact->name ) and $medical_informations->referring_doctor_contact->hidden === false)
                        {{$medical_informations->referring_doctor_contact->name }}</span>
                    @endif

                    @if (isset($medical_informations->referring_doctor_contact->value ) and $medical_informations->referring_doctor_contact->hidden === false)
                        {{$medical_informations->referring_doctor_contact->value }}</span>
                    @endif
            </div>

            <hr class="col-span-2">

            <h3 class="font-bold text-lg col-span-2">Contacts d'urgence <span class="font-light text-base md:pl-4 text-black text-xs md:text-base">(mise à jour, {{$medical_informations->updated_at->diffForHumans()}})</span></h3>
            <div class="col-span-2">
                <div class="grid md:grid-cols-3">
                    @foreach ($medical_informations->emergency_contacts as $contact)
                        <div>
                            <span class="text-sm md:text-base">Nom :</span>
                            <span class="text-black pl-4 text-sm md:text-base">
                                    {{ $contact->name }}</span>
                        </div>
                        <div>
                            <span class="text-sm md:text-base">Contact :</span>
                            <span class="text-black pl-4 text-sm md:text-base">{{ $contact->contact }}</span>
                        </div>
                        <div>
                            <span class="text-sm md:text-base">Statut :</span>
                            <span class="text-black pl-4 text-sm md:text-base">{{ $contact->relation }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <h3 class="font-bold text-lg col-span-2">Assurance <span class="font-light text-base md:pl-4 text-black text-xs md:text-base">(mise à jour, {{$medical_informations->updated_at->diffForHumans()}})</span></h3>
            <div class="col-span-2">
                <div class="grid md:grid-cols-3">
                    <div>
                        <span class="text-sm md:text-base">Nom :</span>
                        <span class="text-black pl-4 text-sm md:text-base">
                            {{ $medical_informations->insurance->name }}
                        </span>
                    </div>
                    <div>
                        <span class="text-sm md:text-base">Numéro :</span>
                        <span class="text-black pl-4 text-sm md:text-base">{{ $medical_informations->insurance->number }}</span>
                    </div>
                    <div>
                        <span class="text-sm md:text-base">Date d'expiration :</span>
                        <span class="text-black pl-4 text-sm md:text-base">{{ $medical_informations->insurance->date }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<footer class="text-center text-center mb-3">
    <span class="text-white font-bold">Copyright © 2024 Djaka Inc. Tous droits réservés.</span>
</footer>
</html>
