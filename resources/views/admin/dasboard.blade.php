<x-admin-layout>
    <x-breadcrumb title="Dashboard"></x-breadcrumb>
    <!-- STATISTIC-->
    <section class="statistic">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="statistic__item">
                            <h2 class="number">{{$userCount}}</h2>
                            <span class="desc">members</span>
                            <div class="icon">
                                <i class="zmdi zmdi-account-o"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="statistic__item">
                            <h2 class="number">{{$numberOrder}}</h2>
                            <span class="desc">items order</span>
                            <div class="icon">
                                <i class="zmdi zmdi-shopping-cart"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="statistic__item">
                            <h2 class="number">{{$numberOrderWeek}}</h2>
                            <span class="desc">this week</span>
                            <div class="icon">
                                <i class="zmdi zmdi-calendar-note"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="statistic__item">
                            <h2 class="number">${{ number_format($sumEarningInMonth)}}</h2>
                            <span class="desc">total earnings</span>
                            <div class="icon">
                                <i class="zmdi zmdi-money"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END STATISTIC-->

    <section>
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-8">
                        <!-- RECENT REPORT 2-->
                        <div class="recent-report2">
                            <h3 class="title-3">recent reports</h3>
                            {{-- <div class="chart-info">
                                <div class="chart-info__left">
                                    <div class="chart-note">
                                        <span class="dot dot--blue"></span>
                                        <span>products</span>
                                    </div>
                                    <div class="chart-note">
                                        <span class="dot dot--green"></span>
                                        <span>Services</span>
                                    </div>
                                </div>
                                <div class="chart-info-right">
                                    <div class="rs-select2--dark rs-select2--md m-r-10">
                                        <select class="js-select2" name="property">
                                            <option selected="selected">All Properties</option>
                                            <option value="">Products</option>
                                            <option value="">Services</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                    <div class="rs-select2--dark rs-select2--sm">
                                        <select class="js-select2 au-select-dark" name="time">
                                            <option selected="selected">All Time</option>
                                            <option value="">By Month</option>
                                            <option value="">By Day</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="recent-report__chart">
                                <canvas id="chart"></canvas>
                            </div>
                        </div>
                        <!-- END RECENT REPORT 2             -->
                    </div>
                    <div class="col-xl-4">
                        <!-- TASK PROGRESS-->
                        <div class="task-progress">
                            <h3 class="title-3">task progress</h3>
                            <div class="au-skill-container">
                                <div class="au-progress">
                                    <span class="au-progress__title">Web Design</span>
                                    <div class="au-progress__bar">
                                        <div class="au-progress__inner js-progressbar-simple" role="progressbar"
                                            data-transitiongoal="90">
                                            <span class="au-progress__value js-value"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="au-progress">
                                    <span class="au-progress__title">HTML5/CSS3</span>
                                    <div class="au-progress__bar">
                                        <div class="au-progress__inner js-progressbar-simple" role="progressbar"
                                            data-transitiongoal="85">
                                            <span class="au-progress__value js-value"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="au-progress">
                                    <span class="au-progress__title">WordPress</span>
                                    <div class="au-progress__bar">
                                        <div class="au-progress__inner js-progressbar-simple" role="progressbar"
                                            data-transitiongoal="95">
                                            <span class="au-progress__value js-value"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="au-progress">
                                    <span class="au-progress__title">Support</span>
                                    <div class="au-progress__bar">
                                        <div class="au-progress__inner js-progressbar-simple" role="progressbar"
                                            data-transitiongoal="95">
                                            <span class="au-progress__value js-value"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END TASK PROGRESS-->
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var labels = {{ Js::from($labels) }};
        var orders = {{ Js::from($data) }};

        const data = {
            labels: labels,
            datasets: [{
                    label: 'My First dataset',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: orders,
                },
                {
                    label: 'My second dataset',
                    backgroundColor: 'rgb(155, 251, 12)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: orders,
                }
            ]
        };

        const config = {
            type: 'line',
            data: data,
            options: {}
        };

        const myChart = new Chart(
            document.getElementById('chart'),
            config
        );
    </script>
</x-admin-layout>
