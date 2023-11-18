@section('title', 'Admin Pannel')
@extends('Admin.Layouts.layout')
@section('content')
    <main>

  <div class="flex flex-col md:flex-row">
    <section>
      <div id="main" class="main-content flex-1 bg-white   mt-12 md:mt-2 pb-24 md:pb-5">

        <div class="bg-white pt-3">
          <div class="rounded-tl-3xl p-4 shadow text-2xl text-gray-900">
            <h1 class="font-bold pl-2">Thống kê</h1>
          </div>
        </div>

        <div class="flex flex-wrap">
          <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Metric Card-->
            <div
              class="bg-gradient-to-b from-green-200 to-green-100 border-b-4 border-green-600 rounded-lg shadow-xl p-5">
              <div class="flex flex-row items-center">
                <div class="flex-shrink pr-4">
                  <div class="rounded-full p-5 bg-green-600"><i class="fa fa-wallet fa-2x fa-inverse"></i></div>
                </div>
                <div class="flex-1 text-right md:text-center">
                  <h2 class="font-bold uppercase text-gray-600">Tổng số sản phẩm</h2>
                  <p class="font-bold text-3xl">
                    <?= product_count() ?> <span class="text-green-500"><i class="fas fa-caret-up"></i></span>
                  </p>
                </div>
              </div>
            </div>
            <!--/Metric Card-->
          </div>
          <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Metric Card-->
            <div
              class="bg-gradient-to-b from-orange-200 to-pink-100 border-b-4 border-pink-500 rounded-lg shadow-xl p-5">
              <div class="flex flex-row items-center">
                <div class="flex-shrink pr-4">
                  <div class="rounded-full p-5 bg-pink-600"><i class="fas fa-users fa-2x fa-inverse"></i></div>
                </div>
                <div class="flex-1 text-right md:text-center">
                  <h2 class="font-bold uppercase text-gray-600">Tổng số tài khoản</h2>
                  <p class="font-bold text-3xl">
                    <?= users_count() ?> <span class="text-pink-500"><i class="fas fa-exchange-alt"></i></span>
                  </p>
                </div>
              </div>
            </div>
            <!--/Metric Card-->
          </div>
          <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Metric Card-->
            <div
              class="bg-gradient-to-b from-yellow-200 to-yellow-100 border-b-4 border-yellow-600 rounded-lg shadow-xl p-5">
              <div class="flex flex-row items-center">
                <div class="flex-shrink pr-4">
                  <div class="rounded-full p-5 bg-yellow-600"><i class="fas fa-user-plus fa-2x fa-inverse"></i></div>
                </div>
                <div class="flex-1 text-right md:text-center">
                  <h2 class="font-bold uppercase text-gray-600">Tổng số danh mục</h2>
                  <p class="font-bold text-3xl">
                    <?= category_count() ?> <span class="text-yellow-600"><i class="fas fa-caret-up"></i></span>
                  </p>
                </div>
              </div>
            </div>
            <!--/Metric Card-->
          </div>
          <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Metric Card-->
            <div class="bg-gradient-to-b from-gray-200 to-blue-100 border-b-4 border-blue-500 rounded-lg shadow-xl p-5">
              <div class="flex flex-row items-center">
                <div class="flex-shrink pr-4">
                  <div class="rounded-full p-5 bg-blue-600"><i class="fas fa-server fa-2x fa-inverse"></i></div>
                </div>
                <div class="flex-1 text-right md:text-center">
                  <h2 class="font-bold uppercase text-gray-600">Tổng số bình luận</h2>
                  <p class="font-bold text-3xl">
                    <?= comments_count_all() ?>
                  </p>
                </div>
              </div>
            </div>
            <!--/Metric Card-->
          </div>

          <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Metric Card-->
            <div
              class="bg-gradient-to-b from-purple-200 to-blue-100 border-b-4 border-blue-500 rounded-lg shadow-xl p-5">
              <div class="flex flex-row items-center">
                <div class="flex-shrink pr-4">
                  <div class="rounded-full p-5 bg-blue-600"><i class="fas fa-server fa-2x fa-inverse"></i></div>
                </div>
                <div class="flex-1 text-right md:text-center">
                  <h2 class="font-bold uppercase text-gray-600">Tổng số doanh thu</h2>
                  <p class="font-bold text-3xl">
                    <?= number_format(total_revenue(), 0, ',', '.') ?> VNĐ
                  </p>
                </div>
              </div>
            </div>
            <!--/Metric Card-->
          </div>

          <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Metric Card-->
            <div
              class="bg-gradient-to-b from-red-200 to-green-100 border-b-4 border-green-600 rounded-lg shadow-xl p-5">
              <div class="flex flex-row items-center">
                <div class="flex-shrink pr-4">
                  <div class="rounded-full p-5 bg-green-600"><i class="fa fa-wallet fa-2x fa-inverse"></i></div>
                </div>
                <div class="flex-1 text-right md:text-center">
                  <h2 class="font-bold uppercase text-gray-600">Tổng số đơn hàng</h2>
                  <p class="font-bold text-3xl">
                    <?= order_count_all() ?> <span class="text-pink-500"><i class="fas fa-caret-up"></i></span>
                  </p>
                </div>
              </div>
            </div>
            <!--/Metric Card-->
          </div>
        </div>


        <div class="flex flex-row flex-wrap flex-grow mt-2">

          <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Graph Card-->
            <div class="bg-white border-transparent rounded-lg shadow-xl">
              <div
                class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 
rounded-tl-lg rounded-tr-lg p-2">
                <h5 class="font-bold uppercase text-gray-600">Tỉ lệ các sản phẩm theo danh mục</h5>
              </div>
              <div class="p-5"><canvas id="chartjs-4" class="chartjs" width="undefined" height="undefined"></canvas>
                <script>
                  new Chart(document.getElementById("chartjs-4"), {
                    "type": "doughnut",
                    "data": {
                      "labels": ["Shorts", "Shirts", "Jeans", "Áo Khoác Blazer"],
                      "datasets": [{
                        "label": "Issues",
                        "data": [<?= product_count_by_category_name("Shorts") ?>,
                          <?= product_count_by_category_name("Shirts") ?>,
                          <?= product_count_by_category_name("Jeans") ?>,
                          <?= product_count_by_category_name("Áo Khoác Blazer") ?>
                        ],
                        "backgroundColor": ["rgb(255, 99, 132)", "rgb(54, 162, 235)", "rgb(255, 205, 86)",
                          "rgb(54, 162, 26)"
                        ]
                      }]
                    }
                  });
                </script>
              </div>
            </div>
            <!--/Graph Card-->
          </div>

          <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Graph Card-->
            <div class="bg-white border-transparent rounded-lg shadow-xl">
              <div
                class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 
rounded-tl-lg rounded-tr-lg p-2">
                <h2 class="font-bold uppercase text-gray-600">Số lượng lượt xem của sản phẩm</h2>
              </div>
              <div class="p-5">
                <canvas id="chartjs-0" class="chartjs" width="undefined" height="undefined"></canvas>
                <script>
                  new Chart(document.getElementById("chartjs-0"), {
                    "type": "line",
                    "data": {
                      "labels": ["January", "February", "March", "April", "May", "June", "July"],
                      "datasets": [{
                        "label": "Total Views",
                        "data": [605, 59, 80, 81, 56, <?= $viewsArr[0][1] ?>, 40],
                        "fill": false,
                        "borderColor": "rgb(75, 192, 192)",
                        "lineTension": 0.1
                      }]
                    },
                    "options": {}
                  });
                </script>
              </div>
            </div>


            <!--/Graph Card-->
          </div>

          <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Graph Card-->
            <div class="bg-white border-transparent rounded-lg shadow-xl">
              <div
                class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 
rounded-tl-lg rounded-tr-lg p-2">
                <h2 class="font-bold uppercase text-gray-600">Tổng số sản phẩm bán được theo tháng</h2>
              </div>
              <div class="p-5">
                <canvas id="chartjs-1" class="chartjs" width="undefined" height="undefined"></canvas>
                <script>
                  new Chart(document.getElementById("chartjs-1"), {
                    "type": "bar",
                    "data": {
                      "labels": ["Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
                      "datasets": [{
                        "label": "Sản phẩm",
                        "data": [5, 4, <?= total_product_by_month('08') ?>, <?= total_product_by_month('09') ?>,
                          <?= total_product_by_month('10') ?>, <?= total_product_by_month('11') ?>,
                          <?= total_product_by_month('12') ?>,
                        ],
                        "fill": false,
                        "backgroundColor": ["rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)",
                          "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)",

                          "rgba(153, 102, 255, 0.2)", "rgba(201, 203, 207, 0.2)"
                        ],
                        "borderColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)",
                          "rgb(75, 192, 192)", "rgb(54, 162, 235)", "rgb(153, 102, 255)", "rgb(201, 203, 207)"
                        ],
                        "borderWidth": 1
                      }]
                    },
                    "options": {
                      "scales": {
                        "yAxes": [{
                          "ticks": {
                            "beginAtZero": true
                          }
                        }]
                      }
                    }
                  });
                </script>
              </div>
            </div>
            <!--/Graph Card-->
          </div>




          <!--/table Card-->
        </div>

        <!--/Advert Card-->
      </div>


  </div>
  </div>
  </section>
  </div>
</main>


    <main>

  <div class="flex flex-col md:flex-row">
    <section>
      <div id="main" class="main-content flex-1 bg-white   mt-12 md:mt-2 pb-24 md:pb-5">

        <div class="bg-white pt-3">
          <div class="rounded-tl-3xl p-4 shadow text-2xl text-gray-900">
            <h1 class="font-bold pl-2">Thống kê</h1>
          </div>
        </div>

        <div class="flex flex-wrap">
          <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Metric Card-->
            <div
              class="bg-gradient-to-b from-green-200 to-green-100 border-b-4 border-green-600 rounded-lg shadow-xl p-5">
              <div class="flex flex-row items-center">
                <div class="flex-shrink pr-4">
                  <div class="rounded-full p-5 bg-green-600"><i class="fa fa-wallet fa-2x fa-inverse"></i></div>
                </div>
                <div class="flex-1 text-right md:text-center">
                  <h2 class="font-bold uppercase text-gray-600">Tổng số sản phẩm</h2>
                  <p class="font-bold text-3xl">
                    <?= product_count() ?> <span class="text-green-500"><i class="fas fa-caret-up"></i></span>
                  </p>
                </div>
              </div>
            </div>
            <!--/Metric Card-->
          </div>
          <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Metric Card-->
            <div
              class="bg-gradient-to-b from-orange-200 to-pink-100 border-b-4 border-pink-500 rounded-lg shadow-xl p-5">
              <div class="flex flex-row items-center">
                <div class="flex-shrink pr-4">
                  <div class="rounded-full p-5 bg-pink-600"><i class="fas fa-users fa-2x fa-inverse"></i></div>
                </div>
                <div class="flex-1 text-right md:text-center">
                  <h2 class="font-bold uppercase text-gray-600">Tổng số tài khoản</h2>
                  <p class="font-bold text-3xl">
                    <?= users_count() ?> <span class="text-pink-500"><i class="fas fa-exchange-alt"></i></span>
                  </p>
                </div>
              </div>
            </div>
            <!--/Metric Card-->
          </div>
          <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Metric Card-->
            <div
              class="bg-gradient-to-b from-yellow-200 to-yellow-100 border-b-4 border-yellow-600 rounded-lg shadow-xl p-5">
              <div class="flex flex-row items-center">
                <div class="flex-shrink pr-4">
                  <div class="rounded-full p-5 bg-yellow-600"><i class="fas fa-user-plus fa-2x fa-inverse"></i></div>
                </div>
                <div class="flex-1 text-right md:text-center">
                  <h2 class="font-bold uppercase text-gray-600">Tổng số danh mục</h2>
                  <p class="font-bold text-3xl">
                    <?= category_count() ?> <span class="text-yellow-600"><i class="fas fa-caret-up"></i></span>
                  </p>
                </div>
              </div>
            </div>
            <!--/Metric Card-->
          </div>
          <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Metric Card-->
            <div class="bg-gradient-to-b from-gray-200 to-blue-100 border-b-4 border-blue-500 rounded-lg shadow-xl p-5">
              <div class="flex flex-row items-center">
                <div class="flex-shrink pr-4">
                  <div class="rounded-full p-5 bg-blue-600"><i class="fas fa-server fa-2x fa-inverse"></i></div>
                </div>
                <div class="flex-1 text-right md:text-center">
                  <h2 class="font-bold uppercase text-gray-600">Tổng số bình luận</h2>
                  <p class="font-bold text-3xl">
                    <?= comments_count_all() ?>
                  </p>
                </div>
              </div>
            </div>
            <!--/Metric Card-->
          </div>

          <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Metric Card-->
            <div
              class="bg-gradient-to-b from-purple-200 to-blue-100 border-b-4 border-blue-500 rounded-lg shadow-xl p-5">
              <div class="flex flex-row items-center">
                <div class="flex-shrink pr-4">
                  <div class="rounded-full p-5 bg-blue-600"><i class="fas fa-server fa-2x fa-inverse"></i></div>
                </div>
                <div class="flex-1 text-right md:text-center">
                  <h2 class="font-bold uppercase text-gray-600">Tổng số doanh thu</h2>
                  <p class="font-bold text-3xl">
                    <?= number_format(total_revenue(), 0, ',', '.') ?> VNĐ
                  </p>
                </div>
              </div>
            </div>
            <!--/Metric Card-->
          </div>

          <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Metric Card-->
            <div
              class="bg-gradient-to-b from-red-200 to-green-100 border-b-4 border-green-600 rounded-lg shadow-xl p-5">
              <div class="flex flex-row items-center">
                <div class="flex-shrink pr-4">
                  <div class="rounded-full p-5 bg-green-600"><i class="fa fa-wallet fa-2x fa-inverse"></i></div>
                </div>
                <div class="flex-1 text-right md:text-center">
                  <h2 class="font-bold uppercase text-gray-600">Tổng số đơn hàng</h2>
                  <p class="font-bold text-3xl">
                    <?= order_count_all() ?> <span class="text-pink-500"><i class="fas fa-caret-up"></i></span>
                  </p>
                </div>
              </div>
            </div>
            <!--/Metric Card-->
          </div>
        </div>


        <div class="flex flex-row flex-wrap flex-grow mt-2">

          <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Graph Card-->
            <div class="bg-white border-transparent rounded-lg shadow-xl">
              <div
                class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 
rounded-tl-lg rounded-tr-lg p-2">
                <h5 class="font-bold uppercase text-gray-600">Tỉ lệ các sản phẩm theo danh mục</h5>
              </div>
              <div class="p-5"><canvas id="chartjs-4" class="chartjs" width="undefined" height="undefined"></canvas>
                <script>
                  new Chart(document.getElementById("chartjs-4"), {
                    "type": "doughnut",
                    "data": {
                      "labels": ["Shorts", "Shirts", "Jeans", "Áo Khoác Blazer"],
                      "datasets": [{
                        "label": "Issues",
                        "data": [<?= product_count_by_category_name("Shorts") ?>,
                          <?= product_count_by_category_name("Shirts") ?>,
                          <?= product_count_by_category_name("Jeans") ?>,
                          <?= product_count_by_category_name("Áo Khoác Blazer") ?>
                        ],
                        "backgroundColor": ["rgb(255, 99, 132)", "rgb(54, 162, 235)", "rgb(255, 205, 86)",
                          "rgb(54, 162, 26)"
                        ]
                      }]
                    }
                  });
                </script>
              </div>
            </div>
            <!--/Graph Card-->
          </div>

          <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Graph Card-->
            <div class="bg-white border-transparent rounded-lg shadow-xl">
              <div
                class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 
rounded-tl-lg rounded-tr-lg p-2">
                <h2 class="font-bold uppercase text-gray-600">Số lượng lượt xem của sản phẩm</h2>
              </div>
              <div class="p-5">
                <canvas id="chartjs-0" class="chartjs" width="undefined" height="undefined"></canvas>
                <script>
                  new Chart(document.getElementById("chartjs-0"), {
                    "type": "line",
                    "data": {
                      "labels": ["January", "February", "March", "April", "May", "June", "July"],
                      "datasets": [{
                        "label": "Total Views",
                        "data": [605, 59, 80, 81, 56, <?= $viewsArr[0][1] ?>, 40],
                        "fill": false,
                        "borderColor": "rgb(75, 192, 192)",
                        "lineTension": 0.1
                      }]
                    },
                    "options": {}
                  });
                </script>
              </div>
            </div>


            <!--/Graph Card-->
          </div>

          <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Graph Card-->
            <div class="bg-white border-transparent rounded-lg shadow-xl">
              <div
                class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 
rounded-tl-lg rounded-tr-lg p-2">
                <h2 class="font-bold uppercase text-gray-600">Tổng số sản phẩm bán được theo tháng</h2>
              </div>
              <div class="p-5">
                <canvas id="chartjs-1" class="chartjs" width="undefined" height="undefined"></canvas>
                <script>
                  new Chart(document.getElementById("chartjs-1"), {
                    "type": "bar",
                    "data": {
                      "labels": ["Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
                      "datasets": [{
                        "label": "Sản phẩm",
                        "data": [5, 4, <?= total_product_by_month('08') ?>, <?= total_product_by_month('09') ?>,
                          <?= total_product_by_month('10') ?>, <?= total_product_by_month('11') ?>,
                          <?= total_product_by_month('12') ?>,
                        ],
                        "fill": false,
                        "backgroundColor": ["rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)",
                          "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)",

                          "rgba(153, 102, 255, 0.2)", "rgba(201, 203, 207, 0.2)"
                        ],
                        "borderColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)",
                          "rgb(75, 192, 192)", "rgb(54, 162, 235)", "rgb(153, 102, 255)", "rgb(201, 203, 207)"
                        ],
                        "borderWidth": 1
                      }]
                    },
                    "options": {
                      "scales": {
                        "yAxes": [{
                          "ticks": {
                            "beginAtZero": true
                          }
                        }]
                      }
                    }
                  });
                </script>
              </div>
            </div>
            <!--/Graph Card-->
          </div>




          <!--/table Card-->
        </div>

        <!--/Advert Card-->
      </div>


  </div>
  </div>
  </section>
  </div>
</main>


    <main>

  <div class="flex flex-col md:flex-row">
    <section>
      <div id="main" class="main-content flex-1 bg-white   mt-12 md:mt-2 pb-24 md:pb-5">

        <div class="bg-white pt-3">
          <div class="rounded-tl-3xl p-4 shadow text-2xl text-gray-900">
            <h1 class="font-bold pl-2">Thống kê</h1>
          </div>
        </div>

        <div class="flex flex-wrap">
          <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Metric Card-->
            <div
              class="bg-gradient-to-b from-green-200 to-green-100 border-b-4 border-green-600 rounded-lg shadow-xl p-5">
              <div class="flex flex-row items-center">
                <div class="flex-shrink pr-4">
                  <div class="rounded-full p-5 bg-green-600"><i class="fa fa-wallet fa-2x fa-inverse"></i></div>
                </div>
                <div class="flex-1 text-right md:text-center">
                  <h2 class="font-bold uppercase text-gray-600">Tổng số sản phẩm</h2>
                  <p class="font-bold text-3xl">
                    <?= product_count() ?> <span class="text-green-500"><i class="fas fa-caret-up"></i></span>
                  </p>
                </div>
              </div>
            </div>
            <!--/Metric Card-->
          </div>
          <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Metric Card-->
            <div
              class="bg-gradient-to-b from-orange-200 to-pink-100 border-b-4 border-pink-500 rounded-lg shadow-xl p-5">
              <div class="flex flex-row items-center">
                <div class="flex-shrink pr-4">
                  <div class="rounded-full p-5 bg-pink-600"><i class="fas fa-users fa-2x fa-inverse"></i></div>
                </div>
                <div class="flex-1 text-right md:text-center">
                  <h2 class="font-bold uppercase text-gray-600">Tổng số tài khoản</h2>
                  <p class="font-bold text-3xl">
                    <?= users_count() ?> <span class="text-pink-500"><i class="fas fa-exchange-alt"></i></span>
                  </p>
                </div>
              </div>
            </div>
            <!--/Metric Card-->
          </div>
          <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Metric Card-->
            <div
              class="bg-gradient-to-b from-yellow-200 to-yellow-100 border-b-4 border-yellow-600 rounded-lg shadow-xl p-5">
              <div class="flex flex-row items-center">
                <div class="flex-shrink pr-4">
                  <div class="rounded-full p-5 bg-yellow-600"><i class="fas fa-user-plus fa-2x fa-inverse"></i></div>
                </div>
                <div class="flex-1 text-right md:text-center">
                  <h2 class="font-bold uppercase text-gray-600">Tổng số danh mục</h2>
                  <p class="font-bold text-3xl">
                    <?= category_count() ?> <span class="text-yellow-600"><i class="fas fa-caret-up"></i></span>
                  </p>
                </div>
              </div>
            </div>
            <!--/Metric Card-->
          </div>
          <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Metric Card-->
            <div class="bg-gradient-to-b from-gray-200 to-blue-100 border-b-4 border-blue-500 rounded-lg shadow-xl p-5">
              <div class="flex flex-row items-center">
                <div class="flex-shrink pr-4">
                  <div class="rounded-full p-5 bg-blue-600"><i class="fas fa-server fa-2x fa-inverse"></i></div>
                </div>
                <div class="flex-1 text-right md:text-center">
                  <h2 class="font-bold uppercase text-gray-600">Tổng số bình luận</h2>
                  <p class="font-bold text-3xl">
                    <?= comments_count_all() ?>
                  </p>
                </div>
              </div>
            </div>
            <!--/Metric Card-->
          </div>

          <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Metric Card-->
            <div
              class="bg-gradient-to-b from-purple-200 to-blue-100 border-b-4 border-blue-500 rounded-lg shadow-xl p-5">
              <div class="flex flex-row items-center">
                <div class="flex-shrink pr-4">
                  <div class="rounded-full p-5 bg-blue-600"><i class="fas fa-server fa-2x fa-inverse"></i></div>
                </div>
                <div class="flex-1 text-right md:text-center">
                  <h2 class="font-bold uppercase text-gray-600">Tổng số doanh thu</h2>
                  <p class="font-bold text-3xl">
                    <?= number_format(total_revenue(), 0, ',', '.') ?> VNĐ
                  </p>
                </div>
              </div>
            </div>
            <!--/Metric Card-->
          </div>

          <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Metric Card-->
            <div
              class="bg-gradient-to-b from-red-200 to-green-100 border-b-4 border-green-600 rounded-lg shadow-xl p-5">
              <div class="flex flex-row items-center">
                <div class="flex-shrink pr-4">
                  <div class="rounded-full p-5 bg-green-600"><i class="fa fa-wallet fa-2x fa-inverse"></i></div>
                </div>
                <div class="flex-1 text-right md:text-center">
                  <h2 class="font-bold uppercase text-gray-600">Tổng số đơn hàng</h2>
                  <p class="font-bold text-3xl">
                    <?= order_count_all() ?> <span class="text-pink-500"><i class="fas fa-caret-up"></i></span>
                  </p>
                </div>
              </div>
            </div>
            <!--/Metric Card-->
          </div>
        </div>


        <div class="flex flex-row flex-wrap flex-grow mt-2">

          <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Graph Card-->
            <div class="bg-white border-transparent rounded-lg shadow-xl">
              <div
                class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 
rounded-tl-lg rounded-tr-lg p-2">
                <h5 class="font-bold uppercase text-gray-600">Tỉ lệ các sản phẩm theo danh mục</h5>
              </div>
              <div class="p-5"><canvas id="chartjs-4" class="chartjs" width="undefined" height="undefined"></canvas>
                <script>
                  new Chart(document.getElementById("chartjs-4"), {
                    "type": "doughnut",
                    "data": {
                      "labels": ["Shorts", "Shirts", "Jeans", "Áo Khoác Blazer"],
                      "datasets": [{
                        "label": "Issues",
                        "data": [<?= product_count_by_category_name("Shorts") ?>,
                          <?= product_count_by_category_name("Shirts") ?>,
                          <?= product_count_by_category_name("Jeans") ?>,
                          <?= product_count_by_category_name("Áo Khoác Blazer") ?>
                        ],
                        "backgroundColor": ["rgb(255, 99, 132)", "rgb(54, 162, 235)", "rgb(255, 205, 86)",
                          "rgb(54, 162, 26)"
                        ]
                      }]
                    }
                  });
                </script>
              </div>
            </div>
            <!--/Graph Card-->
          </div>

          <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Graph Card-->
            <div class="bg-white border-transparent rounded-lg shadow-xl">
              <div
                class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 
rounded-tl-lg rounded-tr-lg p-2">
                <h2 class="font-bold uppercase text-gray-600">Số lượng lượt xem của sản phẩm</h2>
              </div>
              <div class="p-5">
                <canvas id="chartjs-0" class="chartjs" width="undefined" height="undefined"></canvas>
                <script>
                  new Chart(document.getElementById("chartjs-0"), {
                    "type": "line",
                    "data": {
                      "labels": ["January", "February", "March", "April", "May", "June", "July"],
                      "datasets": [{
                        "label": "Total Views",
                        "data": [605, 59, 80, 81, 56, <?= $viewsArr[0][1] ?>, 40],
                        "fill": false,
                        "borderColor": "rgb(75, 192, 192)",
                        "lineTension": 0.1
                      }]
                    },
                    "options": {}
                  });
                </script>
              </div>
            </div>


            <!--/Graph Card-->
          </div>

          <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Graph Card-->
            <div class="bg-white border-transparent rounded-lg shadow-xl">
              <div
                class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 
rounded-tl-lg rounded-tr-lg p-2">
                <h2 class="font-bold uppercase text-gray-600">Tổng số sản phẩm bán được theo tháng</h2>
              </div>
              <div class="p-5">
                <canvas id="chartjs-1" class="chartjs" width="undefined" height="undefined"></canvas>
                <script>
                  new Chart(document.getElementById("chartjs-1"), {
                    "type": "bar",
                    "data": {
                      "labels": ["Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
                      "datasets": [{
                        "label": "Sản phẩm",
                        "data": [5, 4, <?= total_product_by_month('08') ?>, <?= total_product_by_month('09') ?>,
                          <?= total_product_by_month('10') ?>, <?= total_product_by_month('11') ?>,
                          <?= total_product_by_month('12') ?>,
                        ],
                        "fill": false,
                        "backgroundColor": ["rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)",
                          "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)",

                          "rgba(153, 102, 255, 0.2)", "rgba(201, 203, 207, 0.2)"
                        ],
                        "borderColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)",
                          "rgb(75, 192, 192)", "rgb(54, 162, 235)", "rgb(153, 102, 255)", "rgb(201, 203, 207)"
                        ],
                        "borderWidth": 1
                      }]
                    },
                    "options": {
                      "scales": {
                        "yAxes": [{
                          "ticks": {
                            "beginAtZero": true
                          }
                        }]
                      }
                    }
                  });
                </script>
              </div>
            </div>
            <!--/Graph Card-->
          </div>




          <!--/table Card-->
        </div>

        <!--/Advert Card-->
      </div>


  </div>
  </div>
  </section>
  </div>
</main>


@endsection
