@extends('layouts.appprint')

@section('content')
<div >


    <p style="margin-top:0pt; margin-bottom:0pt; line-height:normal; font-size:14pt;"><span
            style="font-family:'Brush Script MT';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
    </p>
    <h1 style="margin-top:0pt; margin-bottom:10pt; page-break-after:avoid; line-height:115%; font-size:14pt;"><span
            style="font-family:'Arial Narrow';">N&deg;CNPS EMPLOYEUR</span><span
            style="font-family:'Arial Narrow';">&nbsp;</span><span style="font-family:'Arial Narrow';">: 374353 </span>
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
   
</div>
@endsection