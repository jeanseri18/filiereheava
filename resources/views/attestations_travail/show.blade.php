@extends('layouts.apprh')

@section('content')
<div class="container">
    <p style="margin-top:0pt; margin-bottom:0pt; line-height:normal;"><span
            style="height:0pt; display:block; position:absolute; z-index:3;"><img
                src="https://myfiles.space/user_files/258325_0814ee78b0547536/1739287656_fiche-d-attestation-de-travail/1739287656_fiche-d-attestation-de-travail-2.jpeg"
                width="184" height="88" alt="C:\Users\SECRETARIAT\Downloads\IMG-20200624-WA0006.jpg"
                style="margin: 0 0 0 auto; display: block; "></span><span
            style="height:0pt; display:block; position:absolute; z-index:0;"><img
                src="https://myfiles.space/user_files/258325_0814ee78b0547536/1739287656_fiche-d-attestation-de-travail/1739287656_fiche-d-attestation-de-travail-1.png"
                width="345" height="70" alt="" style="margin: 0 0 0 auto; display: block; "></span><strong><span
                style="font-family:'Arial Narrow';">&nbsp;</span></strong></p>
    <p style="margin-top:0pt; margin-bottom:10pt;"><span
            style="width:35.4pt; font-family:'Arial Narrow'; display:inline-block;">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-bottom:10pt; line-height:115%; font-size:14pt;"><span
            style="height:0pt; display:block; position:absolute; z-index:1;"><img
                src="https://myfiles.space/user_files/258325_0814ee78b0547536/1739287656_fiche-d-attestation-de-travail/1739287656_fiche-d-attestation-de-travail-3.png"
                width="258" height="4" alt="" style="margin: 0 0 0 auto; display: block; "></span><span
            style="font-family:'Arial Narrow';">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; line-height:normal; font-size:10pt;"><span
            style="height:0pt; display:block; position:absolute; z-index:2;"><img
                src="https://myfiles.space/user_files/258325_0814ee78b0547536/1739287656_fiche-d-attestation-de-travail/1739287656_fiche-d-attestation-de-travail-4.png"
                width="155" height="3" alt="" style="margin: 0 0 0 auto; display: block; "></span><span
            style="font-family:'Arial Black';">DIRECTION EXECUTIVE</span><span
            style="width:11.6pt; font-family:'Arial Black'; font-size:8pt; display:inline-block;">&nbsp;</span><span
            style="width:35.4pt; font-family:'Arial Black'; font-size:8pt; display:inline-block;">&nbsp;</span><span
            style="width:35.4pt; font-family:'Arial Black'; font-size:8pt; display:inline-block;">&nbsp;</span><span
            style="font-family:'Arial Black'; font-size:8pt;">&nbsp;&nbsp;&nbsp;&nbsp;</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; line-height:normal; font-size:14pt;"><span
            style="font-family:'Brush Script MT';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
    </p>
    <h1 style="margin-top:0pt; margin-bottom:10pt; page-break-after:avoid; line-height:115%; font-size:14pt;"><span
            style="font-family:'Arial Narrow';">N&deg;CNPS EMPLOYEUR</span><span
            style="font-family:'Arial Narrow';">&nbsp;</span><span style="font-family:'Arial Narrow';">: {{ $attestation->numero_cnps }} </span>
    </h1>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:115%; font-size:14pt;"><span
            style="font-family:'Arial Narrow';">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:115%; font-size:14pt;"><span
            style="font-family:'Arial Narrow';">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:115%; font-size:14pt;"><span
            style="font-family:'Arial Narrow';">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:115%; font-size:7pt;"><span
            style="font-family:'Arial Narrow';">&nbsp;</span></p>
    <p style="margin-top:0pt; margin-bottom:10pt; text-align:center; line-height:115%; font-size:20pt;"><strong><u><span
                    style="font-family:'Arial Narrow';">ATTESTATION DE TRAVAIL: {{ $attestation->id }}</span></u></strong></p>
    <p style="margin-top:0pt; margin-bottom:10pt; text-align:center; line-height:115%; font-size:1pt;"><strong><span
                style="font-family:'Arial Narrow';">&nbsp;</span></strong></p>
    <p style="margin-top:4.85pt; margin-bottom:6pt; text-align:justify; line-height:115%; font-size:14pt;"><span
            style="font-family:'Arial Narrow'; color:#0d0d0d;">Je soussign&eacute;&nbsp;</span><strong><span
                style="font-family:'Arial Narrow'; color:#0d0d0d;">GBAHI Djoua Luc</span></strong><span
            style="font-family:'Arial Narrow'; color:#0d0d0d;">,Directeur Exécutif de la Fédération des OPA de Producteurs de la Filière Hévéa de Côte d’Ivoire  (</span><strong><span
                style="font-family:'Arial Narrow'; color:#0d0d0d;">FPH-CI</span></strong><span
            style="font-family:'Arial Narrow'; color:#0d0d0d;">),atteste  que&nbsp;</span><strong><span
                style="font-family:'Arial Narrow'; color:#0d0d0d;">M./Mme {{ $attestation->user->nom }}</span></strong><span
            style="font-family:'Arial Narrow'; color:#0d0d0d;">, de num&eacute; matricule</span><strong><span
                style="font-family:'Arial Narrow'; color:#0d0d0d;">
                {{ $attestation->user->matricule }}.</span></strong><strong><span
                style="font-family:'Arial Narrow';">,</span></strong><span
            style="font-family:'Arial Narrow'; color:#0d0d0d;">&nbsp;travaille au sein de ma structure depuis le</span><strong><span style="font-family:'Arial Narrow'; color:#0d0d0d;">
            {{ $attestation->date_embauche->format('d/m/Y') }}.</span></strong></p>
    <p style="margin-top:4.85pt; margin-bottom:6pt; text-align:justify; line-height:115%; font-size:14pt;"><span
            style="font-family:'Arial Narrow'; color:#0d0d0d;">Il/Elle y est sous {{ $attestation->type_contrat }}
            en qualit&eacute; de {{ $attestation->user->fonction }} au
            {{ $attestation->lieu_travail }} (préciser le lieu de travail) de la FPH-CI.</span>
    </p>
    <p style="margin-top:4.85pt; margin-bottom:6pt; text-align:justify; line-height:115%; font-size:14pt;"><span
            style="font-family:'Arial Narrow'; color:#0d0d0d;">En foi de quoi, je lui délivre la présente attestation pour servir et valoir ce que de droit.</span></p>
    <p style="margin-top:0pt; margin-bottom:6pt; line-height:115%; font-size:13pt;"><strong><span
                style="font-family:'Arial Narrow';">&nbsp;</span></strong></p>
    <p style="margin-top:0pt; margin-bottom:6pt; line-height:115%; font-size:9pt;"><strong><span
                style="font-family:'Arial Narrow';">&nbsp;</span></strong></p>
    <p style="margin-top:0pt; margin-bottom:6pt; line-height:115%; font-size:14pt;text-align: end;"><strong><span
                style="line-height:115%; font-family:'Arial Narrow'; font-size:13pt; display:inline-block;">&nbsp;</span></strong><strong><span
                style="line-height:115%; font-family:'Arial Narrow'; font-size:13pt;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </span></strong><strong><span style="font-family:'Arial Narrow';text-align: end;">Fait &agrave; Abidjan, le
            {{ $attestation->created_at->format('d/m/Y')  }}</span></strong></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:115%; font-size:12pt;"><span
            style="font-family:'Arial Narrow'; color:#0d0d0d;">&nbsp;</span></p>

    <p
        style="margin-top:0pt; margin-left:354.5pt; margin-bottom:0pt; text-align: end; line-height:normal; font-size:14pt;">
        <strong><span style="font-family:'Arial Narrow';">Le Directeur Ex&eacute;cutif</span></strong></p>
    <p
        style="margin-top:0pt; margin-left:709pt; margin-bottom:0pt; text-align: end; line-height:115%; font-size:14pt;">
        <span style="font-family:'Arial Narrow';">&nbsp;</span></p>

    <p
        style="margin-top:0pt; margin-left:354.5pt; margin-bottom:0pt; text-align: end; line-height:normal; font-size:14pt;">
        <strong><span style="font-family:'Arial Narrow';">GBAHI Djoua Luc</span></strong></p>

    <p
        style="margin-top:0pt; margin-left:212.7pt; margin-bottom:0pt; text-align: end; line-height:normal; font-size:14pt;">
        <strong><span style="font-family:'Arial Narrow';color:green;">
        {{ $attestation->validation_directeur ? 'Validée' : 'Non validée' }}
        </span></strong></p>
    <p
        style="margin-top:0pt; margin-left:212.7pt; margin-bottom:0pt; text-align: end; line-height:normal; font-size:14pt;">
        <strong><span style="font-family:'Arial Narrow';">&nbsp;</span></strong></p>
    <p
        style="margin-top:0pt; margin-left:212.7pt; margin-bottom:0pt; text-align: end; line-height:normal; font-size:14pt;">
        <strong><span style="font-family:'Arial Narrow';">&nbsp;</span></strong></p>
    <p style="margin-top:0pt; margin-bottom:10pt;">&nbsp;</p>
    <p style="margin-top:0pt; margin-bottom:10pt;">&nbsp;</p>
   <hr/> <div style="clear:both;">
        <p style="margin-top:0pt; margin-bottom:0pt; text-align: center; line-height:normal; font-size:10pt;"><span
                style="height:0pt; text-align:left; display:block; position:absolute; z-index:-65536;"><img
                    src="https://myfiles.space/user_files/258325_0814ee78b0547536/1739287656_fiche-d-attestation-de-travail/1739287656_fiche-d-attestation-de-travail-5.png"
                    width="1039" height="4" alt="" style="margin: 0 0 0 auto; display: block; "></span><strong><span
                    style="font-family:'Arial Narrow'; font-size:9pt;">Si&egrave;ge social</span></strong><strong><span
                    style="font-family:'Arial Narrow'; font-size:9pt;">&nbsp;</span></strong><strong><span
                    style="font-family:'Arial Narrow'; font-size:9pt;">: ******* Cocody Angr&eacute;, Terminus 81-82,
                    entre le coll&egrave;** ********** Cousteau et la ********* du Jubil&eacute;,
                    28</span></strong><strong><span style="font-family:'Arial Narrow'; font-size:9pt; color:#ff0000;">
                </span></strong><strong><span style="font-family:'Arial Narrow'; font-size:9pt;">BP 9** Abidjan 28,
                    T&eacute;l : 27-22-47-59-62, </span></strong><strong><span
                    style="font-family:'Arial Narrow';">E-mail: info@fphci.com</span></strong></p>
        <p style="margin-top:0pt; margin-bottom:10pt;">&nbsp;</p>
    </div>
</div>
@endsection