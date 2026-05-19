@extends('layouts.app')

@section('content')

<section class="setofficers-section">
    <div class="setofficers-container">

        <!-- HEADER -->
        <div class="setofficers-hero">
            <span class="org-badge">Get To Know Us</span>
            <div class="setofficers-header-top">
                <img src="{{ asset('images/Logo.png') }}" alt="Left Logo" class="setofficers-header-logo">

                <div class="setofficers-header-text">
                    <p class="setofficers-header-line1">OFFICE FOR PERSON WITH DISABILITY AFFAIRS</p>
                    <p class="setofficers-header-line2">MUNICIPALITY OF MANOLO FORTICH, BUKIDNON</p>
                </div>

                <img src="{{ asset('images/Logo_PDAO.png') }}" alt="Right Logo" class="setofficers-header-logo">
            </div>

            <h1 class="setofficers-title">SET OF OFFICERS</h1>
        </div>

        <!-- PDAO SECTION -->
        <div class="so-block so-watermark-pdao">
            <div class="so-block-header">
                <h2>PDAO Department</h2>
                <p>Official Department Structure</p>
            </div>

            <div class="so-tree">

                <div class="so-node center">
                    <div class="so-card pdao featured">
                        <div class="so-photo-wrap">
                            <img src="{{ asset('images/org/Tikoy.png') }}" alt="Renante V. Moradas">
                        </div>
                        <h3>RENANTE V. MORADAS</h3>
                        <p>PDAO Head</p>
                    </div>
                </div>

                <div class="so-line vertical"></div>
                <div class="so-line horizontal short"></div>

                <div class="so-grid two-cols">
                    <div class="so-card pdao">
                        <div class="so-photo-wrap">
                            <img src="{{ asset('images/org/Mercy.png') }}" alt="Mercedita B. Balendez">
                        </div>
                        <h3>MERCEDITA B. BALENDEZ</h3>
                        <p>Officer</p>
                    </div>

                    <div class="so-card pdao">
                        <div class="so-photo-wrap">
                            <img src="{{ asset('images/org/Badz.png') }}" alt="Anjanette G. Banda">
                        </div>
                        <h3>ANJANETTE G. BANDA</h3>
                        <p>Officer</p>
                    </div>
                </div>

                <div class="so-line horizontal lower"></div>

                <div class="so-grid two-cols">
                    <div class="so-card pdao">
                        <div class="so-photo-wrap">
                            <img src="{{ asset('images/org/Jiejie.png') }}" alt="Genec B. Quidlat">
                        </div>
                        <h3>GENEC B. QUIDLAT</h3>
                        <p>Staff</p>
                    </div>

                    <div class="so-card pdao">
                        <div class="so-photo-wrap">
                            <img src="{{ asset('images/org/Leomar.png') }}" alt="Leomar B. Baculi">
                        </div>
                        <h3>LEOMAR B. BACULI</h3>
                        <p>Staff</p>
                    </div>
                </div>

            </div>
        </div>

        <!-- DAPA SECTION -->
        <div class="so-block so-watermark-dapa">
            <div class="so-block-header">
                <h2>DAPA Officers</h2>
                <p>Differently Abled Person Association</p>
            </div>

            <div class="so-chart">

                <div class="so-node center">
                    <div class="so-card dapa featured">
                        <div class="so-photo-wrap">
                            <img src="{{ asset('images/dapa/Sto. Niño Rene A. Laspuña.png') }}" alt="Rene A. Laspuña">
                        </div>
                        <h3>RENE A. LASPUÑA</h3>
                        <p>President</p>
                    </div>
                </div>

                <div class="so-line vertical"></div>

                <div class="so-grid two-cols">
                    <div class="so-card dapa">
                        <div class="so-photo-wrap">
                            <img src="{{ asset('images/dapa/Tankulan Diomedes Pinalas.png') }}" alt="Diomedes B. Pinalas">
                        </div>
                        <h3>DIOMEDES B. PINALAS</h3>
                        <p>Vice President</p>
                    </div>

                    <div class="so-card dapa">
                        <div class="so-photo-wrap">
                            <img src="{{ asset('images/dapa/Lunocan Rhobielyn S. Erana.png') }}" alt="Rhobielyn S. Erana">
                        </div>
                        <h3>RHOBIELYN S. ERANA</h3>
                        <p>Secretary</p>
                    </div>
                </div>

                <div class="so-line vertical small"></div>

                <div class="so-grid four-cols">
                    <div class="so-card dapa">
                        <div class="so-photo-wrap">
                            <img src="{{ asset('images/dapa/Sankanan Shirley M. Besingan.png') }}" alt="Shirley M. Besingan">
                        </div>
                        <h3>SHIRLEY M. BESINGAN</h3>
                        <p>Treasurer</p>
                    </div>

                    <div class="so-card dapa">
                        <div class="so-photo-wrap">
                            <img src="{{ asset('images/dapa/Guilang-Guilang Norwell Jhon A. Abunda.png') }}" alt="Norwel John A. Abunda">
                        </div>
                        <h3>NORWEL JOHN A. ABUNDA</h3>
                        <p>Auditor</p>
                    </div>

                    <div class="so-card dapa">
                        <div class="so-photo-wrap">
                            <img src="{{ asset('images/dapa/Sankanan Shirley M. Besingan.png') }}" alt="Shirley M. Besingan">
                        </div>
                        <h3>SHIRLEY M. BESINGAN</h3>
                        <p>PIO</p>
                    </div>

                    <div class="so-card dapa">
                        <div class="so-photo-wrap">
                            <img src="{{ asset('images/dapa/Maluko Annie I. Buyoc.png') }}" alt="Annie I. Buyoc">
                        </div>
                        <h3>ANNIE I. BUYOC</h3>
                        <p>PIO</p>
                    </div>
                </div>

                <div class="so-line vertical small"></div>

                <div class="so-grid two-cols">
                    <div class="so-card dapa mini">
                        <div class="so-photo-wrap small-photo">
                            <img src="{{ asset('images/dapa/Mambatangan Marissa S. Hagtusan.png') }}" alt="Marissa S. Hagtusan">
                        </div>
                        <h3>MARISSA S. HAGTUSAN</h3>
                        <p>PIO</p>
                    </div>

                    <div class="so-card dapa mini">
                        <div class="so-photo-wrap small-photo">
                            <img src="{{ asset('images/dapa/Dahilayan Adelfo S. Lugmay.png') }}" alt="Adelfo S. Lugmay">
                        </div>
                        <h3>ADELFO S. LUGMAY</h3>
                        <p>PIO</p>
                    </div>
                </div>

            </div>
        </div>

        <!-- PMAG SECTION -->
        <div class="so-block so-watermark-pmag">
            <div class="so-block-header">
                <h2>PMAG Officers</h2>
                <p>Parent Mobilization Action Group</p>
            </div>

            <div class="so-pmag-chart">

                <div class="so-node center">
                    <div class="so-card pmag featured">
                        <div class="so-photo-wrap">
                            <img src="{{ asset('images/pmag/Agusan Canyon Evelisa Masadas.png') }}" alt="Evelisa Masadas">
                        </div>
                        <h3>EVELISA MASADAS</h3>
                        <p>President</p>
                    </div>
                </div>

                <div class="so-line vertical"></div>

                <div class="so-grid two-cols">
                    <div class="so-card pmag">
                        <div class="so-photo-wrap">
                            <img src="{{ asset('images/pmag/Alae Jenie Espinola.png') }}" alt="Jenie Espinola">
                        </div>
                        <h3>JENIE ESPINOLA</h3>
                        <p>Vice President</p>
                    </div>

                    <div class="so-card pmag">
                        <div class="so-photo-wrap">
                            <img src="{{ asset('images/pmag/Dahilayan Rene Boy Gamal.png') }}" alt="Rene Boy Gamal">
                        </div>
                        <h3>RENE BOY GAMAL</h3>
                        <p>Secretary</p>
                    </div>
                </div>

                <div class="so-line vertical small"></div>

                <div class="so-grid four-cols">
                    <div class="so-card pmag">
                        <div class="so-photo-wrap">
                            <img src="{{ asset('images/pmag/Dalirig Bernaliza G. Pacudan.png') }}" alt="Bernaliza G. Pacudan">
                        </div>
                        <h3>BERNALIZA G. PACUDAN</h3>
                        <p>Treasurer</p>
                    </div>

                    <div class="so-card pmag">
                        <div class="so-photo-wrap">
                            <img src="{{ asset('images/pmag/Damilag Ignacia E. Mata.png') }}" alt="Ignacia E. Mata">
                        </div>
                        <h3>IGNACIA E. MATA</h3>
                        <p>Auditor</p>
                    </div>

                    <div class="so-card pmag">
                        <div class="so-photo-wrap">
                            <img src="{{ asset('images/pmag/Dicklum Lourina S. Ochavo.png') }}" alt="Lourina S. Ochavo">
                        </div>
                        <h3>LOURINA S. OCHAVO</h3>
                        <p>PIO</p>
                    </div>

                    <div class="so-card pmag">
                        <div class="so-photo-wrap">
                            <img src="{{ asset('images/pmag/Guilang-Guilang Rowena S. Abunda.png') }}" alt="Rowena S. Abunda">
                        </div>
                        <h3>ROWENA S. ABUNDA</h3>
                        <p>PIO</p>
                    </div>
                </div>

                <div class="so-line vertical small"></div>

                <div class="so-grid two-cols">
                    <div class="so-card pmag mini">
                        <div class="so-photo-wrap small-photo">
                            <img src="{{ asset('images/pmag/Lingi-on Mary Jane Bustamante.png') }}" alt="Mary Jane Bustamante">
                        </div>
                        <h3>MARY JANE BUSTAMANTE</h3>
                        <p>PIO</p>
                    </div>

                    <div class="so-card pmag mini">
                        <div class="so-photo-wrap small-photo">
                            <img src="{{ asset('images/pmag/Lunocan Metchil M. Ranque.png') }}" alt="Metchil M. Ranque">
                        </div>
                        <h3>METCHIL M. RANQUE</h3>
                        <p>PIO</p>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

@endsection