@extends('layouts.layout')

@section('content')
    <div class="container-fluid all-centered">
        <div class="row text-center">
            <div class="col-sm-2 ">
                <div class="sidenav left">
                    <div class="hub">
                        <span>Poor</span>
                        <span>hub</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-7 col-scroll">
                <h2>Standard PitchingMore Stats Glossary · Hide Partial · Show Minors · SHARE · CSV · PRE · LINK · More Tools
                    Minors
                    Game Logs [+]
                    Splits [+]
                    HR Log
                    vs. Batter
                    Finders [+]
                    Year	Age	Tm	Lg	W	L	W-L%	ERA	G	GS	GF	CG	SHO	SV	IP	H	R	ER	HR	BB	IBB	SO	HBP	BK	WP	BF	ERA+ WHIP	H/9	HR/9	BB/9	SO/9	SO/BB	Awards
                    1986	23	CHC	NL	7	4	.636	5.05	16	16	0	1	1	0	87.1	107	52	49	10	42	1	45	3	3	3	395	80	1.706	11.0	1.0 4.3	4.6	1.07
                    1987	24	CHC	NL	12	15	.444	5.10	35	33	1	1	0	0	201.0	210	127	114	28	97	9	147	5	2	11	899	83	1.527 9.4	1.3	4.3	6.6	1.52
                    1988	25	CHC	NL	9	15	.375	3.48	34	30	1	3	1	0	202.0	212	84	78	20	55	7	121	4	0	4	855	105	1.322	9.4 0.9	2.5	5.4	2.20
                    1989	26	TEX	AL	4	9	.308	4.86	15	15	0	1	0	0	76.0	84	51	41	10	33	0	44	2	0	1	337	82	1.539	9.9	1.2	3.9 5.2	1.33
                    1990	27	TEX	AL	2	6	.250	4.66	33	10	6	1	0	0	102.1	115	59	53	6	39	4	58	4	0	1	447	85	1.505	10.1	0.5	3.4 5.1	1.49
                    1991	28	STL	NL	0	5	.000	5.74	8	7	1	0	0	0	31.1	38	21	20	5	16	0	20	1	1	2	142	65	1.723	10.9	1.4	4.6	5.7 1.25
                    1993	30	BAL	AL	12	9	.571	3.43	25	25	0	3	1	0	152.0	154	63	58	11	38	2	90	6	1	1	630	130	1.263	9.1	0.7 2.3	5.3	2.37
                    1994	31	BAL	AL	5	7	.417	4.77	23	23	0	0	0	0	149.0	158	81	79	23	38	3	87	2	0	1	631	105	1.315	9.5	1.4 2.3	5.3	2.29
                    1995	32	BAL	AL	8	6	.571	5.21	27	18	3	0	0	0	115.2	117	70	67	18	30	0	65	3	0	0	483	92	1.271	9.1	1.4	2.3 5.1	2.17
                    1996	33	TOT	AL	13	3	.813	3.98	34	21	1	0	0	0	160.2	177	86	71	23	46	5	79	2	1	3	703	126	1.388	9.9	1.3 2.6	4.4	1.72
                    1996	33	BOS	AL	7	1	.875	4.50	23	10	1	0	0	0	90.0	111	50	45	14	27	2	50	1	1	2	405	113	1.533	11.1	1.4 2.7	5.0	1.85
                    1996	33	SEA	AL	6	2	.750	3.31	11	11	0	0	0	0	70.2	66	36	26	9	19	3	29	1	0	1	298	150	1.203	8.4	1.1	2.4 3.7	1.53
                    1997	34	SEA	AL	17	5	.773	3.86	30	30	0	2	0	0	188.2	187	82	81	21	43	2	113	7	0	3	787	116	1.219	8.9	1.0 2.1	5.4	2.63
                    1998	35	SEA	AL	15	9	.625	3.53	34	34	0	4	3	0	234.1	234	99	92	23	42	2	158	10	1	3	974	131	1.178	9.0 0.9	1.6	6.1	3.76
                    1999	36	SEA	AL	14	8	.636	3.87	32	32	0	4	0	0	228.0	235	108	98	23	48	1	137	9	0	3	945	130	1.241	9.3 0.9	1.9	5.4	2.85	CYA-6
                    2000	37	SEA	AL	13	10	.565	5.49	26	26	0	0	0	0	154.0	173	103	94	22	53	2	98	3	1	4	678	83	1.468	10.1 1.3	3.1	5.7	1.85
                    2001	38	SEA	AL	20	6	.769	3.43	33	33	0	1	0	0	209.2	187	84	80	24	44	4	119	10	0	1	851	122	1.102	8.0 1.0	1.9	5.1	2.70	CYA-4
                    2002	39	SEA	AL	13	8	.619	3.32	34	34	0	4	2	0	230.2	198	89	85	28	50	4	147	9	0	3	931	128	1.075	7.7	1.1 2.0	5.7	2.94
                    2003	40	SEA	AL	21	7	.750	3.27	33	33	0	1	0	0	215.0	199	83	78	19	66	3	129	8	0	0	897	132	1.233	8.3	0.8 2.8	5.4	1.95	AS,CYA-5
                    2004	41	SEA	AL	7	13	.350	5.21	34	33	1	1	0	0	202.0	217	127	117	44	63	3	125	11	0	1	888	87	1.386	9.7 2.0	2.8	5.6	1.98
                    2005	42	SEA	AL	13	7	.650	4.28	32	32	0	1	0	0	200.0	225	99	95	23	52	2	102	8	0	3	868	98	1.385	10.1	1.0 2.3	4.6	1.96
                    2006	43	TOT	MLB	11	14	.440	4.30	33	33	0	2	1	0	211.1	228	110	101	33	51	5	108	5	1	3	894	105	1.320 9.7	1.4	2.2	4.6	2.12
                    2006	43	SEA	AL	6	12	.333	4.39	25	25	0	2	1	0	160.0	179	85	78	25	44	3	82	3	1	3	685	101	1.394	10.1	1.4 2.5	4.6	1.86
                    2006	43	PHI	NL	5	2	.714	4.03	8	8	0	0	0	0	51.1	49	25	23	8	7	2	26	2	0	0	209	117	1.091	8.6	1.4	1.2	4.6 3.71
                    2007	44	PHI	NL	14	12	.538	5.01	33	33	0	1	0	0	199.1	222	118	111	30	66	3	133	5	0	2	867	91	1.445	10.0 1.4	3.0	6.0	2.02
                    2008	45	PHI	NL	16	7	.696	3.71	33	33	0	0	0	0	196.1	199	85	81	20	62	4	123	11	0	3	841	118	1.329	9.1 0.9	2.8	5.6	1.98
                    2009	46	PHI	NL	12	10	.545	4.94	30	25	1	0	0	0	162.0	177	91	89	27	43	1	94	10	1	1	699	85	1.358	9.8	1.5 2.4	5.2	2.19
                    2010	47	PHI	NL	9	9	.500	4.84	19	19	0	2	1	0	111.2	103	64	60	20	20	0	63	6	0	0	460	84	1.101	8.3	1.6	1.6 5.1	3.15
                    24 Seasons	267	204	.567	4.24	686	628	15	33	10	0	4020.1	4156	2036	1892	*511*	1137	67	2405	144 12	57	17102	104	1.317	9.3	1.1	2.5	5.4	2.12
                    162 Game Avg.	14	11	.567	4.24	36	32	1	2	1	0	208	215	105	98	26	59	3	124	7	1	3	885	104	1.317	9.3	1.1 2.5	5.4	2.12
                    Lg	W	L	W-L%	ERA	G	GS	GF	CG	SHO	SV	IP	H	R	ER	HR	BB	IBB	SO	HBP	BK	WP	BF	ERA+	WHIP	H/9	HR/9 BB/9	SO/9	SO/BB	Awards
                    SEA (11 yrs)	145	87	.625	3.97	324	323	1	20	6	0	2093.0	2100	995	924	261	524	29	1239	79	3	25	8802 113	1.254	9.0	1.1	2.3	5.3	2.36
                    PHI (5 yrs)	56	40	.583	4.55	123	118	1	3	1	0	720.2	750	383	364	105	198	10	439	34	1	6	3076	96	1.315 9.4	1.3	2.5	5.5	2.22
                    CHC (3 yrs)	28	34	.452	4.42	85	79	2	5	2	0	490.1	529	263	241	58	194	17	313	12	5	18	2149	90	1.475 9.7	1.1	3.6	5.7	1.61
                    BAL (3 yrs)	25	22	.532	4.41	75	66	3	3	1	0	416.2	429	214	204	52	106	5	242	11	1	2	1744	108	1.284	9.3 1.1	2.3	5.2	2.28
                    TEX (2 yrs)	6	15	.286	4.74	48	25	6	2	0	0	178.1	199	110	94	16	72	4	102	6	0	2	784	84	1.520	10.0	0.8 3.6	5.1	1.42
                    STL (1 yr)	0	5	.000	5.74	8	7	1	0	0	0	31.1	38	21	20	5	16	0	20	1	1	2	142	65	1.723	10.9	1.4	4.6	5.7	1.25
                    BOS (1 yr)	7	1	.875	4.50	23	10	1	0	0	0	90.0	111	50	45	14	27	2	50	1	1	2	405	113	1.533	11.1	1.4	2.7	5.0 1.85
                    AL (16 yrs)	AL	183	125	.594	4.10	470	424	11	25	7	0	2778.0	2839	1369	1267	343	729	40	1633	97	5	31 11735	110	1.284	9.2	1.1	2.4	5.3	2.24
                    NL (9 yrs)	NL	84	79	.515	4.53	216	204	4	8	3	0	1242.1	1317	667	625	168	408	27	772	47	7	26	5367	93 1.389	9.5	1.2	3.0	5.6	1.89

                </h2>

            </div>
            <div class="col-sm-2 ">
                <div class="sidenav right">
                    <div class="location">
                        <p>Select Your State: </p>
                        <select name="country" id="country">
                            @foreach(CountryState::getStates('US') as $state)
                                <option value="{{$state}}">{{ $state }}</option>
                            @endforeach
                        </select>

                        <p id="demo">Or Click The Button To Select Your Current Location</p>

                        <button onclick="getLocation()">Select Current Location</button>
                        <div id="mapholder"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>



@endsection