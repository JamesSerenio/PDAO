@extends('layouts.app')

@section('content')

<section class="org-section">
    <div class="org-container">

        <div class="org-hero">
            <span class="org-badge">Get To Know Us</span>
            <div class="org-header-top">
                <img src="{{ asset('images/Logo.png') }}" alt="Left Logo" class="org-header-logo">
                <h1 class="org-title">Organizational Structure</h1>
                <img src="{{ asset('images/Logo_PDAO.png') }}" alt="Right Logo" class="org-header-logo">
            </div>
            <p class="org-subtitle">
                Official structure of the Person with Disability Affairs Office and the
                Manolo Fortich Federation of Differently Abled Person Association.
            </p>
        </div>

        {{-- PDAO OFFICE --}}
        <div class="org-block pdao">
            <div class="org-block-header">
                <h2>Person With Disability Affairs Office</h2>
            </div>

            <div class="org-chart org-chart-office">

                <div class="org-level single">
                    <div class="org-card featured">
                        <div class="org-photo-wrap">
                            <img src="{{ asset('images/org/Mayor.png') }}" alt="Hon. Rogelio N. Quiño">
                        </div>
                        <h3>HON. ROGELIO N. QUIÑO</h3>
                        <p>MUNICIPAL MAYOR</p>
                    </div>
                </div>

                <div class="org-line vertical"></div>

                <div class="org-level single">
                    <div class="org-card featured secondary">
                        <div class="org-photo-wrap">
                            <img src="{{ asset('images/org/Tikoy.png') }}" alt="Renante V. Moradas">
                        </div>
                        <h3>RENANTE V. MORADAS</h3>
                        <p>PDAO-OIC / DATA CONTROLLER I</p>
                    </div>
                </div>

                <div class="org-line vertical short"></div>
                <div class="org-line horizontal"></div>

                <div class="org-level two-cols">
                    <div class="org-card">
                        <div class="org-photo-wrap">
                            <img src="{{ asset('images/org/Mercy.png') }}" alt="Mercedita B. Balendez">
                        </div>
                        <h3>MERCEDITA B. BALENDEZ</h3>
                        <p>ADMINISTRATIVE AIDE IV</p>
                        <span>(CLERK II)</span>
                    </div>

                    <div class="org-card">
                        <div class="org-photo-wrap">
                            <img src="{{ asset('images/org/Badz.png') }}" alt="Anjanette G. Banda">
                        </div>
                        <h3>ANJANETTE G. BANDA</h3>
                        <p>ADMINISTRATIVE AIDE IV</p>
                        <span>(CLERK II)</span>
                    </div>
                </div>

                <div class="org-line horizontal lower"></div>

                <div class="org-level two-cols lower-level">
                    <div class="org-card">
                        <div class="org-photo-wrap">
                            <img src="{{ asset('images/org/Jiejie.png') }}" alt="Genec B. Quidlat">
                        </div>
                        <h3>GENEC B. QUIDLAT</h3>
                        <p>ADMINISTRATIVE AIDE IV</p>
                        <span>(CLERK II)</span>
                    </div>

                    <div class="org-card">
                        <div class="org-photo-wrap">
                            <img src="{{ asset('images/org/Leomar.png') }}" alt="Leomar B. Baculi">
                        </div>
                        <h3>LEOMAR B. BACULI</h3>
                        <p>ADMINISTRATIVE AIDE IV</p>
                        <span>(CLERK II)</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- FIRST FEDERATION DAPA --}}
        <div class="org-block federation-block dapa">
            <div class="org-block-header">
                <h2>Manolo Fortich Federation of Differently Abled Person Association</h2>
                <p>(President of 22 Barangay)</p>
            </div>

            <div class="federation-grid">

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/dapa/Agusan Canyon Celerina J. Tacbobo.png') }}" alt="Celerina J. Tacbobo"></div>
                    <h3>CELERINA J. TACBOBO</h3>
                    <p>AGUSAN</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/dapa/Alae Samson P. Cañete.png') }}" alt="Samson P. Cañete"></div>
                    <h3>SAMSON P. CAÑETE</h3>
                    <p>ALAE</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/dapa/Dahilayan Adelfo S. Lugmay.png') }}" alt="Adelfo S. Lugmay"></div>
                    <h3>ADELFO S. LUGMAY</h3>
                    <p>DAHILAYAN</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/dapa/Dalirig Ma. Tessie S. Andilan.png') }}" alt="Ma. Tessie S. Andilan"></div>
                    <h3>MA. TESSIE S. ANDILAN</h3>
                    <p>DALIRIG</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/dapa/Damilag Nilo Aparecio.png') }}" alt="Nilo Aparecio"></div>
                    <h3>NILO A. APARECIO</h3>
                    <p>DAMILAG</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/dapa/Dicklum Nicholas V. Mendez.png') }}" alt="Nicholas V. Mendez"></div>
                    <h3>NICHOLAS V. MENDEZ</h3>
                    <p>DICKLUM</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/dapa/Guilang-Guilang Norwell Jhon A. Abunda.png') }}" alt="Norwel Jhon A. Abunda"></div>
                    <h3>NORWEL JOHN A. ABUNDA</h3>
                    <p>GUILANG-GUILANG</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/dapa/Kalugmanan Merlinda B. Buyoc.png') }}" alt="Merlinda B. Buyoc"></div>
                    <h3>MERLINDA B. BUYOC</h3>
                    <p>KALUGMANAN</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/dapa/Lindaban Raceil B. Gawahan.png') }}" alt="Raceil B. Gawahan"></div>
                    <h3>RACEIL B. GAWAHAN</h3>
                    <p>LINDABAN</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/dapa/Lingi-on Junjie L. Villazorda.png') }}" alt="Junjie L. Villazorda"></div>
                    <h3>JUNJIE L. VILLAZORDA</h3>
                    <p>LINGI-ON</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/dapa/Lunocan Rhobielyn S. Erana.png') }}" alt="Rhobielyn S. Erana"></div>
                    <h3>RHOBIELYN S. ERANA</h3>
                    <p>LUNOCAN</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/dapa/Maluko Annie I. Buyoc.png') }}" alt="Annie I. Buyoc"></div>
                    <h3>ANNIE I. BUYOC</h3>
                    <p>MALUKO</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/dapa/Mambatangan Marissa S. Hagtusan.png') }}" alt="Marissa S. Hagtusan"></div>
                    <h3>MARISSA S. HAGTUSAN</h3>
                    <p>MAMBATANGAN</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/dapa/Mampayag Junard B. Fabro.png') }}" alt="Junard B. Fabro"></div>
                    <h3>JUNARD B. FABRO</h3>
                    <p>MAMPAYAG</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/dapa/Mantibugao Vilma Baculio.png') }}" alt="Vilma Baculio"></div>
                    <h3>VILMA BACULIO</h3>
                    <p>MANTIBUGAO</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/dapa/Minsuro Jeson L. Labininay.png') }}" alt="Jeson L. Labininay"></div>
                    <h3>JESON L. LABININAY</h3>
                    <p>MINSURO</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/dapa/San Miguel Winnie C. Marañon.png') }}" alt="Winnie C. Marañon"></div>
                    <h3>WINNIE C. MARAÑON</h3>
                    <p>SAN MIGUEL</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/dapa/Sankanan Shirley M. Besingan.png') }}" alt="Shirley M. Besingan"></div>
                    <h3>SHIRLEY M. BESINGAN</h3>
                    <p>SANKANAN</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/dapa/Santiago Reynabel S. Hagtungan.png') }}" alt="Reynabel S. Hagtungan"></div>
                    <h3>REYNABEL S. HAGTUNGAN</h3>
                    <p>SANTIAGO</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/dapa/Sto. Niño Rene A. Laspuña.png') }}" alt="Rene A. Laspuña"></div>
                    <h3>RENE A. LASPUÑA</h3>
                    <p>STO. NIÑO</p>
                </div>

            </div>

            <div class="federation-last-row">
                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/dapa/Tankulan Diomedes Pinalas.png') }}" alt="Diomedes Pinalas"></div>
                    <h3>DIOMEDES PINALAS</h3>
                    <p>TANKULAN</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/dapa/Ticala Jonaslyn P. Dag-uman.png') }}" alt="Jonaslyn P. Dag-uman"></div>
                    <h3>JONASLYN P. DAG-UMAN</h3>
                    <p>TICALA</p>
                </div>
            </div>
        </div>

        {{-- SECOND FEDERATION PMAG --}}
        <div class="org-block federation-block pmag">
            <div class="org-block-header">
                <h2>Manolo Fortich Federation of Parent Mobilization Action Group</h2>
                <p>(President of 22 Barangay)</p>
            </div>

            <div class="federation-grid">

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/pmag/Agusan Canyon Evelisa Masadas.png') }}" alt="Evelisa Masadas"></div>
                    <h3>EVELISA MASADAS</h3>
                    <p>AGUSAN</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/pmag/Alae Jenie Espinola.png') }}" alt="Jenie Espinola"></div>
                    <h3>JENIE ESPINOLA</h3>
                    <p>ALAE</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/pmag/Dahilayan Rene Boy Gamal.png') }}" alt="Rene Boy Gamal"></div>
                    <h3>RENE BOY GAMAL</h3>
                    <p>DAHILAYAN</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/pmag/Dalirig Bernaliza G. Pacudan.png') }}" alt="Bernaliza G. Pacudan"></div>
                    <h3>BERNALIZA G. PACUDAN</h3>
                    <p>DALIRIG</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/pmag/Damilag Ignacia E. Mata.png') }}" alt="Ignacia E. Mata"></div>
                    <h3>IGNACIA E. MATA</h3>
                    <p>DAMILAG</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/pmag/Dicklum Lourina S. Ochavo.png') }}" alt="Lourina S. Ochavo"></div>
                    <h3>LOURINA S. OCHAVO</h3>
                    <p>DICKLUM</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/pmag/Guilang-Guilang Rowena S. Abunda.png') }}" alt="Rowena S. Abunda"></div>
                    <h3>ROWENA S. ABUNDA</h3>
                    <p>GUILANG-GUILANG</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/pmag/Kalugmanan Enerlyn S. Pinohon.png') }}" alt="Enerlyn S. Pinohon"></div>
                    <h3>ENERLYN S. PINOHON</h3>
                    <p>KALUGMANAN</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/pmag/Lindaban Tesien R. Oyanon.png') }}" alt="Tesien R. Oyanon"></div>
                    <h3>TESIEN R. OYANON</h3>
                    <p>LINDABAN</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/pmag/Lingi-on Mary Jane Bustamante.png') }}" alt="Mary Jane Bustamante"></div>
                    <h3>MARY JANE BUSTAMANTE</h3>
                    <p>LINGI-ON</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/pmag/Lunocan Metchil M. Ranque.png') }}" alt="Metchil M. Ranque"></div>
                    <h3>METCHIL M. RANQUE</h3>
                    <p>LUNOCAN</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/pmag/Maluko Eden C. Cabactulan.png') }}" alt="Eden C. Cabactulan"></div>
                    <h3>EDEN C. CABACTULAN</h3>
                    <p>MALUKO</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/pmag/Mambatangan Teresita B. Paculanang.png') }}" alt="Teresita B. Paculanang"></div>
                    <h3>TERESITA B. PACULANANG</h3>
                    <p>MAMBATANGAN</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/pmag/Mampayag Marializa S. Labnotin.png') }}" alt="Marializa S. Labnotin"></div>
                    <h3>MARIALIZA S. LABNOTIN</h3>
                    <p>MAMPAYAG</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/pmag/Mantibugao Jenny Ann J. Galla.png') }}" alt="Jenny Ann J. Galla"></div>
                    <h3>JENNY ANN J. GALLA</h3>
                    <p>MANTIBUGAO</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/pmag/Minsuro Cresencia L. Labininay.png') }}" alt="Cresencia L. Labininay"></div>
                    <h3>CRESENCIA L. LABININAY</h3>
                    <p>MINSURO</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/pmag/San Miguel Cecilia Dano.png') }}" alt="Cecilia Dano"></div>
                    <h3>CECILIA DANO</h3>
                    <p>SAN MIGUEL</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/pmag/Sankanan Wenita M. Quiray.png') }}" alt="Wenita M. Quiray"></div>
                    <h3>WENITA M. QUIRAY</h3>
                    <p>SANKANAN</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/pmag/Santiago Nancy Bayaon.png') }}" alt="Nancy Bayaon"></div>
                    <h3>NANCY BAYAON</h3>
                    <p>SANTIAGO</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/pmag/Sto. Niño Ofelia G. Pinote.png') }}" alt="Ofelia G. Pinote"></div>
                    <h3>OFELIA G. PINOTE</h3>
                    <p>STO. NIÑO</p>
                </div>
            </div>

            <div class="federation-last-row">
                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/pmag/Tankulan Job Abaton.png') }}" alt="Job Abaton"></div>
                    <h3>JOB ABATON</h3>
                    <p>TANKULAN</p>
                </div>

                <div class="org-card mini">
                    <div class="org-photo-wrap"><img src="{{ asset('images/pmag/Ticala Thelma B. Linotao.png') }}" alt="Thelma B. Linotao"></div>
                    <h3>THELMA B. LINOTAO</h3>
                    <p>TICALA</p>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection