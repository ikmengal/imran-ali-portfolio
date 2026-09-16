const purpleColor = '#836AF9',
    yellowColor = '#ffe800',
    cyanColor = '#28dac6',
    orangeColor = '#FF8132',
    orangeLightColor = '#FDAC34',
    oceanBlueColor = '#299AFF',
    greyColor = '#4F5D70',
    greyLightColor = '#EDF1F4',
    blueColor = '#2B9AFF',
    blueLightColor = '#84D0FF',
    legendColor = '#6e6b7b',
    borderColor = '#ebe9f1';

    // Color constant
    const chartColors = {
        column: {
            series1: '#826af9',
            series2: '#d2b0ff',
            bg: '#f8d3ff'
        },
        donut: {
            series1: '#fee802',
            series2: '#3fd0bd',
            series3: '#826bf8',
            series4: '#2b9bf4'
        },
        area: {
            series1: '#29dac7',
            series2: '#60f2ca',
            series3: '#a5f8cd'
        }
    };

function getApprovedSalesAmount(route, type){
    var secoundRoute = $('#equipment_cost').attr('data-route');
    $.ajax({
        type: "get",
        url: route,
        data: { type: type },
        success: function (res) {
        if (res.success == true) {
            $("#daily_approved_sales_amount").text(res.data.daily);
            $("#weekly_approved_sales_amount").text(res.data.weekly);
            $("#monthly_approved_sales_amount").text(res.data.monthly);
            supportTracker(res.data.percantage);
        } else {
            console.log("getApprovedSalesAmount-- Error");
            console.log(res.message);
        }

        if (res.data.errors && res.data.errors.length != 0) {
            var c = 0;
            $.each(res.data.errors, function (index, value) {
            if (value && value.message && value.message != "") {
                if(c == 0) {
                    $(".allCardsErrorBoxDiv").removeClass('d-none');
                    c++
                }
                $(".allCardsErrorBox").append('<li> '+value.message+' </li>');
            }
            });
        }
        },
        error: function (xhr, status, error) {
            console.log("getApprovedSalesAmount-- " + error);
        },
        complete: function(xhr, status, error) {
            if (!$(".approved_sales_amount_spinner").hasClass("d-none")) {
                $(".approved_sales_amount_spinner").addClass("d-none")
            }
            totalEquipmentCost(secoundRoute, 'equipment-cost')
        }
    });
}

function totalEquipmentCost(route, type){
    var secoundRoute = $('#revenueGenerated').attr('data-route');
    $.ajax({
        type: "get",
        url: route,
        data: { type: type },
        success: function (res) {
            if (res.success == true) {
                $('#equipment_cost_data').html(res.html);
                weeklyEarningReports(res.data.weekly_data);
            } else {
                console.log(res.message);
            }
        },
        error: function (xhr, status, error) {
            console.log("totalEquipmentCost-- " + error);
        },
        complete: function(xhr, status, error) {
            if (!$(".equipment_cost_spinner").hasClass("d-none")) {
                $(".equipment_cost_spinner").addClass("d-none")
            }
            totalActiveAccounts(secoundRoute, 'active_accounts')
        }
    });
}

function totalActiveAccounts(route, type){
    var secoundRoute = $('#buyback_amount').attr('data-route');
    $.ajax({
        type: "get",
        url: route,
        data: { type: type },
        success: function (res) {
        if (res.success == true) {
            $("#" + type).text(res.data.active_users_count);
            $("#monthly_active_account").text(res.data.current_month_active_user_count);
            getTotalActiveAccounts(res.data.users)
            getMonthlyActiveAccount(res.data.current_month_active_users)
        } else {
            console.log("totalActiveAccounts-- Error");
            console.log(res.message);
        }

        if (res.data.errors && res.data.errors.length != 0) {
            var c = 0;
            $.each(res.data.errors, function (index, value) {
            if (value && value.message && value.message != "") {
                if(c == 0) {
                $(".allCardsErrorBoxDiv").removeClass('d-none');
                c++
                }
                $(".allCardsErrorBox").append('<li> '+value.message+' </li>');
            }
            });
        }
        },
        error: function (xhr, status, error) {
            console.log("totalActiveAccounts-- " + error);
        },
        complete: function(xhr, status, error) {
            if (!$(".total_active_accounts_spinner").hasClass("d-none") || !$(".monthly_active_accounts_spinner").hasClass("d-none")) {
                $(".total_active_accounts_spinner").addClass("d-none")
                $(".monthly_active_accounts_spinner").addClass("d-none")
            }
            buybackAmount(secoundRoute, 'buyback_amount')
        }
    });
}

function buybackAmount(route, type){
    var secoundRoute = $('#agent_wise_sale_amount').attr('data-route');
    $.ajax({
        type: "get",
        url: route,
        data: { type: type },
        success: function (res) {
            if (res.success == true) {
                $("#buyback_amount_daily").text(res.data.daily);
                $("#buyback_amount_weekly").text(res.data.weekly);
                $("#buyback_amount_monthly").text(res.data.monthly);
            } else {
                console.log(res.message);
            }
        },
        error: function (xhr, status, error) {
            console.log("buybackAmount-- " + error);
        },
        complete: function(xhr, status, error) {
            if (!$(".buyback_amount_spinner").hasClass("d-none")) {
                $(".buyback_amount_spinner").addClass("d-none")
            }
            agentWiseSaleAmount(secoundRoute, 'agent-wise-sale-amount')
        }
    });
}

function agentWiseSaleAmount(route, type){
    // var secoundRoute = $('#agent_wise_sale_amount').attr('data-route');
    $.ajax({
        type: "get",
        url: route,
        data: { type: type },
        success: function (res) {
            $('#agent_wise_sale_amount_data').html(res);
        },
        error: function (xhr, status, error) {
            console.log("agentWiseSaleAmount-- " + error);
        },
        complete: function(xhr, status, error) {
            if (!$(".agent_wise_sale_amount_spinner").hasClass("d-none")) {
                $(".agent_wise_sale_amount_spinner").addClass("d-none")
            }
            // totalActiveAccounts(secoundRoute, 'agent-wise-sale-amount')
        }
    });
}

function ticketCategory(route, type){
    var secoundRoute = $('#active-tickets').attr('data-route');
    $.ajax({
        type: "get",
        url: route,
        data: { type: type },
        success: function (res) {
            if (res.success == true) {
                $("#ticket_category_daily").text(res.data.daily);
                $("#ticket_category_weekly").text(res.data.weekly);
                $("#ticket_category_monthly").text(res.data.monthly);
            } else {
                console.log(res.message);
            }
        },
        error: function (xhr, status, error) {
            console.log("ticketCategory-- " + error);
        },
        complete: function(xhr, status, error) {
            activeTickets(secoundRoute, 'active_tickets')
        }
    });
}

function activeTickets(route, type){
    var secoundRoute = $('#active-feeds').attr('data-route');
    $.ajax({
        type: "get",
        url: route,
        data: { type: type },
        success: function (res) {
        if (res.success == true) {
            activeTicketGragh(res.data.ticket);
            $("#active_tickets_count").text(res.data.active_ticket_count);
        } else {
            console.log("activeTickets-- Error");
            console.log(res.message);
        }

        if (res.data.errors && res.data.errors.length != 0) {
            var c = 0;
            $.each(res.data.errors, function (index, value) {
            if (value && value.message && value.message != "") {
                if(c == 0) {
                    $(".allCardsErrorBoxDiv").removeClass('d-none');
                    c++
                }
                $(".allCardsErrorBox").append('<li> '+value.message+' </li>');
            }
            });
        }
        },
        error: function (xhr, status, error) {
            console.log("activeTickets-- " + error);
        },
        complete: function(xhr, status, error) {
            ticketFeeds(secoundRoute, 'ticket_feeds')
        }
    });
}

function ticketFeeds(route, type){
    var secoundRoute = $('#closed-tickets').attr('data-route');
    $.ajax({
        type: "get",
        url: route,
        data: { type: type },
        success: function (res) {
            if (res.success == true) {
                ticketsFeed(res.data.ticket);
                $("#active_feeds_count").text(res.data.active_feeds_count);
            } else {
                console.log("ticketFeeds-- Error");
                console.log(res.message);
            }

            if (res.data.errors && res.data.errors.length != 0) {
                var c = 0;
                $.each(res.data.errors, function (index, value) {
                    if (value && value.message && value.message != "") {
                        if(c == 0) {
                            $(".allCardsErrorBoxDiv").removeClass('d-none');
                            c++
                        }
                        $(".allCardsErrorBox").append('<li> '+value.message+' </li>');
                    }
                });
            }
        },
        error: function (xhr, status, error) {
            console.log("ticketFeeds-- " + error);
        },
        complete: function(xhr, status, error) {
            closedTickets(secoundRoute, 'closed_tickets')
        }
    });
}

function closedTickets(route, type){
    var secoundRoute = $('#resolve-tickets').attr('data-route');
    $.ajax({
        type: "get",
        url: route,
        data: { type: type },
        success: function (res) {
        if (res.success == true) {
            ClosedTickets(res.data.ticket);
            $("#closed_tickets").text(res.data.closed_tickets_count);
        } else {
            console.log("closedTickets-- Error");
            console.log(res.message);
        }

        if (res.data.errors && res.data.errors.length != 0) {
            var c = 0;
            $.each(res.data.errors, function (index, value) {
            if (value && value.message && value.message != "") {
                if(c == 0) {
                    $(".allCardsErrorBoxDiv").removeClass('d-none');
                    c++
                }
                $(".allCardsErrorBox").append('<li> '+value.message+' </li>');
            }
            });
        }
        },
        error: function (xhr, status, error) {
            console.log("closedTickets-- " + error);
        },
        complete: function(xhr, status, error) {
            resolvedTickets(secoundRoute, 'resolve_tickets')
        }
    });
}

function resolvedTickets(route, type){
    var secoundRoute = $('#equipment-cost-yearly').attr('data-route');
    $.ajax({
        type: "get",
        url: route,
        data: { type: type },
        success: function (res) {
        if (res.success == true) {
            ResolvedTickets(res.data.ticket);
            $("#resolve_tickets").text(res.data.resolve_tickets_count);
        } else {
            console.log("resolveTickets-- Error");
            console.log(res.message);
        }

        if (res.data.errors && res.data.errors.length != 0) {
            var c = 0;
            $.each(res.data.errors, function (index, value) {
            if (value && value.message && value.message != "") {
                if(c == 0) {
                    $(".allCardsErrorBoxDiv").removeClass('d-none');
                    c++
                }
                $(".allCardsErrorBox").append('<li> '+value.message+' </li>');
            }
            });
        }
        },
        error: function (xhr, status, error) {
            console.log("resolveTickets-- " + error);
        },
        complete: function(xhr, status, error) {
            equipmentYearly(secoundRoute)
        }
    });
}

let cardColor, headingColor, labelColor, shadeColor, grayColor;
if (isDarkStyle) {
cardColor = config.colors_dark.cardColor;
labelColor = config.colors_dark.textMuted;
headingColor = config.colors_dark.headingColor;
shadeColor = 'dark';
grayColor = '#5E6692'; // gray color is for stacked bar chart
} else {
cardColor = config.colors.cardColor;
labelColor = config.colors.textMuted;
headingColor = config.colors.headingColor;
shadeColor = '';
grayColor = '#817D8D';
}

// Total Active Accounts
// --------------------------------------------------------------------
//   const swiperWithPagination = document.querySelector('#swiper-with-pagination-cards');
//   if (swiperWithPagination) {
//     new Swiper(swiperWithPagination, {
//       loop: true,
//       autoplay: {
//         delay: 2500,
//         disableOnInteraction: false
//       },
//       pagination: {
//         clickable: true,
//         el: '.swiper-pagination'
//       }
//     });
//   }

// Revenue Generated Area Chart
// --------------------------------------------------------------------
function getTotalActiveAccounts(count){
    var allCount = (count && count.length !== 0) ? count : [];
    const revenueGeneratedEl = document.querySelector('#revenueGenerated'),
    revenueGeneratedConfig = {
        chart: {
        height: 130,
        type: 'area',
        parentHeightOffset: 0,
        toolbar: {
            show: false
        },
        sparkline: {
            enabled: true
        }
        },
        markers: {
        colors: 'transparent',
        strokeColors: 'transparent'
        },
        grid: {
        show: false
        },
        colors: [config.colors.success],
        fill: {
        type: 'gradient',
        gradient: {
            shade: shadeColor,
            shadeIntensity: 0.8,
            opacityFrom: 0.6,
            opacityTo: 0.1
        }
        },
        dataLabels: {
        enabled: false
        },
        stroke: {
        width: 2,
        curve: 'smooth'
        },
        series: [
        {
            data: allCount,
        }
        ],
        xaxis: {
        show: true,
        lines: {
            show: false
        },
        labels: {
            show: false
        },
        stroke: {
            width: 0
        },
        axisBorder: {
            show: false
        }
        },
        yaxis: {
        stroke: {
            width: 0
        },
        show: false
        },
        tooltip: {
        enabled: false
        }
    };
    if (typeof revenueGeneratedEl !== undefined && revenueGeneratedEl !== null) {
    const revenueGenerated = new ApexCharts(revenueGeneratedEl, revenueGeneratedConfig);
    revenueGenerated.render();
    }
}

// Revenue Generated Area Chart
// --------------------------------------------------------------------
function getMonthlyActiveAccount(count){
var allCount = (count && count.length !== 0) ? count : [];
    const revenueGeneratedE2 = document.querySelector('#revenueGenerated2'),
    revenueGeneratedConfig2 = {
        chart: {
        height: 130,
        type: 'area',
        parentHeightOffset: 0,
        toolbar: {
            show: false
        },
        sparkline: {
            enabled: true
        }
        },
        markers: {
        colors: 'transparent',
        strokeColors: 'transparent'
        },
        grid: {
        show: false
        },
        colors: [config.colors.warning],
        fill: {
        type: 'gradient',
        gradient: {
            shade: shadeColor,
            shadeIntensity: 0.8,
            opacityFrom: 0.6,
            opacityTo: 0.1
        }
        },
        dataLabels: {
        enabled: false
        },
        stroke: {
        width: 2,
        curve: 'smooth'
        },
        series: [
        {
            data: allCount,
        }
        ],
        xaxis: {
        show: true,
        lines: {
            show: false
        },
        labels: {
            show: false
        },
        stroke: {
            width: 0
        },
        axisBorder: {
            show: false
        }
        },
        yaxis: {
        stroke: {
            width: 0
        },
        show: false
        },
        tooltip: {
        enabled: false
        }
    };
    if (typeof revenueGeneratedE2 !== undefined && revenueGeneratedE2 !== null) {
    const revenueGenerated = new ApexCharts(revenueGeneratedE2, revenueGeneratedConfig2);
    revenueGenerated.render();
    }
}

// Approved Sales Amount - Radial Bar Chart
// --------------------------------------------------------------------
function supportTracker(percentage) {
    const supportTrackerEl = document.querySelector('#supportTracker'),
    supportTrackerOptions = {
      series: [percentage],
      labels: ['Monthly Approved Sales'],
      chart: {
        height: 360,
        type: 'radialBar'
      },
      plotOptions: {
        radialBar: {
          offsetY: 10,
          startAngle: -140,
          endAngle: 130,
          hollow: {
            size: '65%'
          },
          track: {
            background: cardColor,
            strokeWidth: '100%'
          },
          dataLabels: {
            name: {
              offsetY: -20,
              color: labelColor,
              fontSize: '13px',
              fontWeight: '400',
              fontFamily: 'Public Sans'
            },
            value: {
              offsetY: 10,
              color: headingColor,
              fontSize: '38px',
              fontWeight: '600',
              fontFamily: 'Public Sans'
            }
          }
        }
      },
      colors: [config.colors.primary],
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'dark',
          shadeIntensity: 0.5,
          gradientToColors: [config.colors.primary],
          inverseColors: true,
          opacityFrom: 1,
          opacityTo: 0.6,
          stops: [30, 70, 100]
        }
      },
      stroke: {
        dashArray: 10
      },
      grid: {
        padding: {
          top: -20,
          bottom: 5
        }
      },
      states: {
        hover: {
          filter: {
            type: 'none'
          }
        },
        active: {
          filter: {
            type: 'none'
          }
        }
      },
    };
    if (typeof supportTrackerEl !== undefined && supportTrackerEl !== null) {
    const supportTracker = new ApexCharts(supportTrackerEl, supportTrackerOptions);
    supportTracker.render();
    }
}

// Earning Reports Bar Chart
// --------------------------------------------------------------------
function weeklyEarningReports(count){
    var allCount = (count && count.length !== 0) ? count : [];
    const weeklyEarningReportsEl = document.querySelector('#weeklyEarningReports'),
    weeklyEarningReportsConfig = {
        chart: {
        height: 202,
        parentHeightOffset: 0,
        type: 'bar',
        toolbar: {
            show: false
        }
        },
        plotOptions: {
        bar: {
            barHeight: '60%',
            columnWidth: '38%',
            startingShape: 'rounded',
            endingShape: 'rounded',
            borderRadius: 4,
            distributed: true
        }
        },
        grid: {
        show: false,
        padding: {
            top: -30,
            bottom: 0,
            left: -10,
            right: -10
        }
        },
        colors: [
        config.colors_label.primary,
        config.colors_label.primary,
        config.colors_label.primary,
        config.colors_label.primary,
        config.colors.primary,
        config.colors_label.primary,
        config.colors_label.primary
        ],
        dataLabels: {
        enabled: false
        },
        series: [
        {
            data: allCount,
        }
        ],
        legend: {
        show: false
        },
        xaxis: {
        categories: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
        axisBorder: {
            show: false
        },
        axisTicks: {
            show: false
        },
        labels: {
            style: {
            colors: labelColor,
            fontSize: '13px',
            fontFamily: 'Public Sans'
            }
        }
        },
        yaxis: {
        labels: {
            show: false
        }
        },
        tooltip: {
        enabled: false
        },
        responsive: [
        {
            breakpoint: 1025,
            options: {
            chart: {
                height: 199
            }
            }
        }
        ]
    };
    if (typeof weeklyEarningReportsEl !== undefined && weeklyEarningReportsEl !== null) {
    const weeklyEarningReports = new ApexCharts(weeklyEarningReportsEl, weeklyEarningReportsConfig);
    weeklyEarningReports.render();
    }
}

// Total Active Accounts
// --------------------------------------------------------------------
//   const swiperWithPagination = document.querySelector('#swiper-with-pagination-cards');
//   if (swiperWithPagination) {
//     new Swiper(swiperWithPagination, {
//       loop: true,
//       autoplay: {
//         delay: 2500,
//         disableOnInteraction: false
//       },
//       pagination: {
//         clickable: true,
//         el: '.swiper-pagination'
//       }
//     });
//   }

// activeTicketGragh Chart
// --------------------------------------------------------------------
function activeTicketGragh(count){
    var allCount = (count && count.length !== 0) ? count : [];
    const activeTickets = document.querySelector('#activeTickets'),
    revenueGeneratedConfig = {
        chart: {
        height: 130,
        type: 'area',
        parentHeightOffset: 0,
        toolbar: {
            show: false
        },
        sparkline: {
            enabled: true
        }
        },
        markers: {
        colors: 'transparent',
        strokeColors: 'transparent'
        },
        grid: {
        show: false
        },
        colors: [config.colors.success],
        fill: {
        type: 'gradient',
        gradient: {
            shade: shadeColor,
            shadeIntensity: 0.8,
            opacityFrom: 0.6,
            opacityTo: 0.1
        }
        },
        dataLabels: {
        enabled: false
        },
        stroke: {
        width: 2,
        curve: 'smooth'
        },
        series: [
        {
            data: allCount,
        }
        ],
        xaxis: {
        show: true,
        lines: {
            show: false
        },
        labels: {
            show: false
        },
        stroke: {
            width: 0
        },
        axisBorder: {
            show: false
        }
        },
        yaxis: {
        stroke: {
            width: 0
        },
        show: false
        },
        tooltip: {
        enabled: false
        }
    };
    if (typeof activeTickets !== undefined && activeTickets !== null) {
    const revenueGenerated = new ApexCharts(activeTickets, revenueGeneratedConfig);
    revenueGenerated.render();
    }
}

// ticketsFeed Chart
// --------------------------------------------------------------------
function ticketsFeed(count){
    var allCount = (count && count.length !== 0) ? count : [];
    const ticketsFeed = document.querySelector('#ticketsFeed'),
    revenueGeneratedConfig = {
        chart: {
        height: 130,
        type: 'area',
        parentHeightOffset: 0,
        toolbar: {
            show: false
        },
        sparkline: {
            enabled: true
        }
        },
        markers: {
        colors: 'transparent',
        strokeColors: 'transparent'
        },
        grid: {
        show: false
        },
        colors: [config.colors.warning],
        fill: {
        type: 'gradient',
        gradient: {
            shade: shadeColor,
            shadeIntensity: 0.8,
            opacityFrom: 0.6,
            opacityTo: 0.1
        }
        },
        dataLabels: {
        enabled: false
        },
        stroke: {
        width: 2,
        curve: 'smooth'
        },
        series: [
        {
            data: allCount,
        }
        ],
        xaxis: {
        show: true,
        lines: {
            show: false
        },
        labels: {
            show: false
        },
        stroke: {
            width: 0
        },
        axisBorder: {
            show: false
        }
        },
        yaxis: {
        stroke: {
            width: 0
        },
        show: false
        },
        tooltip: {
        enabled: false
        }
    };
    if (typeof ticketsFeed !== undefined && ticketsFeed !== null) {
    const revenueGenerated = new ApexCharts(ticketsFeed, revenueGeneratedConfig);
    revenueGenerated.render();
    }
}

// ClosedTickets Chart
// --------------------------------------------------------------------
function ClosedTickets(count){
    var allCount = (count && count.length !== 0) ? count : [];
    const ClosedTickets = document.querySelector('#ClosedTickets'),
    revenueGeneratedConfig = {
        chart: {
        height: 130,
        type: 'area',
        parentHeightOffset: 0,
        toolbar: {
            show: false
        },
        sparkline: {
            enabled: true
        }
        },
        markers: {
        colors: 'transparent',
        strokeColors: 'transparent'
        },
        grid: {
        show: false
        },
        colors: [config.colors.danger],
        fill: {
        type: 'gradient',
        gradient: {
            shade: shadeColor,
            shadeIntensity: 0.8,
            opacityFrom: 0.6,
            opacityTo: 0.1
        }
        },
        dataLabels: {
        enabled: false
        },
        stroke: {
        width: 2,
        curve: 'smooth'
        },
        series: [
        {
            data: allCount,
        }
        ],
        xaxis: {
        show: true,
        lines: {
            show: false
        },
        labels: {
            show: false
        },
        stroke: {
            width: 0
        },
        axisBorder: {
            show: false
        }
        },
        yaxis: {
        stroke: {
            width: 0
        },
        show: false
        },
        tooltip: {
        enabled: false
        }
    };
    if (typeof ClosedTickets !== undefined && ClosedTickets !== null) {
    const revenueGenerated = new ApexCharts(ClosedTickets, revenueGeneratedConfig);
    revenueGenerated.render();
    }
}

// ClosedTickets Chart
// --------------------------------------------------------------------
function ResolvedTickets(count){
    var allCount = (count && count.length !== 0) ? count : [];
    const ResolvedTickets = document.querySelector('#ResolvedTickets'),
    revenueGeneratedConfig = {
        chart: {
        height: 130,
        type: 'area',
        parentHeightOffset: 0,
        toolbar: {
            show: false
        },
        sparkline: {
            enabled: true
        }
        },
        markers: {
        colors: 'transparent',
        strokeColors: 'transparent'
        },
        grid: {
        show: false
        },
        colors: [config.colors.info],
        fill: {
        type: 'gradient',
        gradient: {
            shade: shadeColor,
            shadeIntensity: 0.8,
            opacityFrom: 0.6,
            opacityTo: 0.1
        }
        },
        dataLabels: {
        enabled: false
        },
        stroke: {
        width: 2,
        curve: 'smooth'
        },
        series: [
        {
            data: allCount,
        }
        ],
        xaxis: {
        show: true,
        lines: {
            show: false
        },
        labels: {
            show: false
        },
        stroke: {
            width: 0
        },
        axisBorder: {
            show: false
        }
        },
        yaxis: {
        stroke: {
            width: 0
        },
        show: false
        },
        tooltip: {
        enabled: false
        }
    };
    if (typeof ResolvedTickets !== undefined && ResolvedTickets !== null) {
    const revenueGenerated = new ApexCharts(ResolvedTickets, revenueGeneratedConfig);
    revenueGenerated.render();
    }
}

// Total Earning Chart - Bar Chart
// --------------------------------------------------------------------
const totalEarningChartEl = document.querySelector('#totalEarningChart'),
totalEarningChartOptions = {
    series: [
    {
        name: 'Earning',
        data: [15, 10, 20, 8, 12, 18, 12, 5]
    },
    {
        name: 'Expense',
        data: [-7, -10, -7, -12, -6, -9, -5, -8]
    }
    ],
    chart: {
    height: 230,
    parentHeightOffset: 0,
    stacked: true,
    type: 'bar',
    toolbar: { show: false }
    },
    tooltip: {
    enabled: false
    },
    legend: {
    show: false
    },
    plotOptions: {
    bar: {
        horizontal: false,
        columnWidth: '18%',
        borderRadius: 5,
        startingShape: 'rounded',
        endingShape: 'rounded'
    }
    },
    colors: [config.colors.primary, grayColor],
    dataLabels: {
    enabled: false
    },
    grid: {
    show: false,
    padding: {
        top: -40,
        bottom: -20,
        left: -10,
        right: -2
    }
    },
    xaxis: {
    labels: {
        show: false
    },
    axisTicks: {
        show: false
    },
    axisBorder: {
        show: false
    }
    },
    yaxis: {
    labels: {
        show: false
    }
    },
    responsive: [
    {
        breakpoint: 1468,
        options: {
        plotOptions: {
            bar: {
            columnWidth: '22%'
            }
        }
        }
    },
    {
        breakpoint: 1197,
        options: {
        chart: {
            height: 228
        },
        plotOptions: {
            bar: {
            borderRadius: 8,
            columnWidth: '26%'
            }
        }
        }
    },
    {
        breakpoint: 783,
        options: {
        chart: {
            height: 232
        },
        plotOptions: {
            bar: {
            borderRadius: 6,
            columnWidth: '28%'
            }
        }
        }
    },
    {
        breakpoint: 589,
        options: {
        plotOptions: {
            bar: {
            columnWidth: '16%'
            }
        }
        }
    },
    {
        breakpoint: 520,
        options: {
        plotOptions: {
            bar: {
            borderRadius: 6,
            columnWidth: '18%'
            }
        }
        }
    },
    {
        breakpoint: 426,
        options: {
        plotOptions: {
            bar: {
            borderRadius: 5,
            columnWidth: '20%'
            }
        }
        }
    },
    {
        breakpoint: 381,
        options: {
        plotOptions: {
            bar: {
            columnWidth: '24%'
            }
        }
        }
    }
    ],
    states: {
    hover: {
        filter: {
        type: 'none'
        }
    },
    active: {
        filter: {
        type: 'none'
        }
    }
    }
};

if (typeof totalEarningChartEl !== undefined && totalEarningChartEl !== null) {
const totalEarningChart = new ApexCharts(totalEarningChartEl, totalEarningChartOptions);
totalEarningChart.render();
}

function getSalesTeamWiseStates(route, type, record){
    var secoundRoute = $('#agent-wise-states').attr('data-route');
    $.ajax({
        type: "get",
        url: route,
        data: { type: type, record:record },
        beforeSend: function() {
            $(".sales_team_wise_states_spinner").removeClass("d-none");
        },
        success: function (res) {
            $('#sales-states-data').html(res);
        },
        error: function (xhr, status, error) {
            console.log("Sales Team Wise States-- " + error);
        },
        complete: function(xhr, status, error) {
            if (!$(".sales_team_wise_states_spinner").hasClass("d-none")) {
                $(".sales_team_wise_states_spinner").addClass("d-none")
            }
            getAgentWiseStates(secoundRoute, 'agent-wise-states', record)
        }
    });
}

function getAgentWiseStates(route, type, record){
    var secoundRoute = $('#region-wise-states').attr('data-route');
    $.ajax({
        type: "get",
        url: route,
        data: { type: type, record:record },
        beforeSend: function() {
            $(".agent_wise_states_spinner").removeClass("d-none");
        },
        success: function (res) {
            $('#agent-wise-states-data').html(res);
        },
        error: function (xhr, status, error) {
            console.log("Agent Wise States-- " + error);
        },
        complete: function(xhr, status, error) {
            if (!$(".agent_wise_states_spinner").hasClass("d-none")) {
                $(".agent_wise_states_spinner").addClass("d-none")
            }
        RegionWiseStates(secoundRoute, 'region-wise-states', record)
        }
    });
}

function RegionWiseStates(route, type, record){
    var secoundRoute = $('#credit-max').attr('data-route');
    $.ajax({
        type: "get",
        url: route,
        data: { type: type, record:record },
        beforeSend: function() {
            $(".region_wise_states_spinner").removeClass("d-none");
        },
        success: function (res) {
            if (res.success == true) {
                RegionWiseStatesGraph(res.data);
            } else {
                RegionWiseStatesGraph(res.data);
            }
        },
        error: function (xhr, status, error) {
            console.log("totalEquipmentCost-- " + error);
        },
        complete: function(xhr, status, error) {
            if (!$(".region_wise_states_spinner").hasClass("d-none")) {
                $(".region_wise_states_spinner").addClass("d-none")
            }
            CreditMix(secoundRoute, 'credit-max', record)
        }
    })
}

function CreditMix(route, type, record){
    var secoundRoute = $('#sales-per-provider').attr('data-route');
    $.ajax({
        type: "get",
        url: route,
        data: { type: type, record:record },
        beforeSend: function() {
            $(".credit_max_spinner").removeClass("d-none");
        },
        success: function (res) {
            if (res.success == true) {
                CreditMixGraph(res.data);
            } else {
                CreditMixGraph(res.data);
            }
        },
        error: function (xhr, status, error) {
            console.log("totalEquipmentCost-- " + error);
        },
        complete: function(xhr, status, error) {
            if (!$(".credit_max_spinner").hasClass("d-none")) {
                $(".credit_max_spinner").addClass("d-none")
            }
            salesPerProvider(secoundRoute, 'sales-per-provider', record)
        }
    })
}

function salesPerProvider(route, type, record){
    var secoundRoute = $('#equipment-cost-yearly').attr('data-route');
    $.ajax({
        type: "get",
        url: route,
        data: { type: type, record:record },
        beforeSend: function() {
            $(".sales_per_provider_spinner").removeClass("d-none");
        },
        success: function (res) {
            $('#sales-per-provider-data').html(res);
        },
        error: function (xhr, status, error) {
            console.log("Agent Wise States-- " + error);
        },
        complete: function(xhr, status, error) {
            if (!$(".sales_per_provider_spinner").hasClass("d-none")) {
            $(".sales_per_provider_spinner").addClass("d-none")
        }
        equipmentYearly(secoundRoute)
        }
    });
}

function equipmentYearly(route){
    var secoundRoute = $('#resolevd-ticket-yearly').attr('data-route');
    $.ajax({
        type: "get",
        url: route,
        data: null,
        beforeSend: function() {
            $(".equipment-cost-yearly_spinner").removeClass("d-none");
        },
        success: function (res) {
            equipmentCostByYear(res);
        },
        error: function (xhr, status, error) {
            console.log("Equipment Cost Yearly-- " + error);
        },
        complete: function(xhr, status, error) {
            if (!$(".equipment-cost-yearly_spinner").hasClass("d-none")) {
            $(".equipment-cost-yearly_spinner").addClass("d-none")
        }
        ticketYearly(secoundRoute);
        }
    });
}

function ticketYearly(route){
    // var secoundRoute = $('#resolevd-ticket-yearly').attr('data-route');
    $.ajax({
        type: "get",
        url: route,
        data:null,
        beforeSend: function() {
            $(".resolved-ticket-yearly_spinner").removeClass("d-none");
        },
        success: function (res) {
            resolvedTicketYearly(res.totals, res.labels);
        },
        error: function (xhr, status, error) {
            console.log("Resolved Ticket Yearly-- " + error);
        },
        complete: function(xhr, status, error) {
            if (!$(".resolved-ticket-yearly_spinner").hasClass("d-none")) {
            $(".resolved-ticket-yearly_spinner").addClass("d-none")
        }
        // ticketYearly(secoundRoute);
        }
    });
}

let equipmentCostChart = null;
let resolvedTicketChart = null;

// Donut Chart Region Wise States
    let donutChart = null;
    function RegionWiseStatesGraph(data) {
        var allCount = (data && data.length !== 0) ? data : [];
        const donutChartEl = document.querySelector('#region-wise-states-donutChart');

        const donutChartConfig = {
            chart: {
                height: 335,
                type: 'donut'
            },
            labels: allCount.name,
            series: allCount.values,
            colors: [
                '#7367F0', '#FF9F43'
            ],
            stroke: {
                show: false,
                curve: 'straight'
            },
            dataLabels: {
                enabled: true,
                formatter: function(val, opt) {
                    return parseInt(val, 10) + '%';
                }
            },
            legend: {
                show: true,
                position: 'bottom',
                markers: { offsetX: -3 },
                itemMargin: {
                    vertical: 3,
                    horizontal: 10
                },
                labels: {
                    colors: legendColor,
                    useSeriesColors: false
                }
            },
            plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            show: true,
                            name: {
                                fontSize: '2rem',
                                fontFamily: 'Open Sans'
                            },
                            value: {
                                fontSize: '1.2rem',
                                color: legendColor,
                                fontFamily: 'Open Sans',
                                formatter: function(val) {
                                    return parseInt(val, 10) + '%';
                                }
                            },
                            total: {
                                show: true,
                                fontSize: '1.5rem',
                                color: headingColor,
                                label: 'Total',
                                formatter: function(w) {
                                    const total = w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                    return total;
                                }
                            }
                        }
                    }
                }
            },
            responsive: [
                {
                    breakpoint: 992,
                    options: {
                        chart: {
                            height: 380
                        },
                        legend: {
                            position: 'bottom',
                            labels: {
                                colors: legendColor,
                                useSeriesColors: false
                            }
                        }
                    }
                },
                {
                    breakpoint: 576,
                    options: {
                        chart: {
                            height: 320
                        },
                        plotOptions: {
                            pie: {
                                donut: {
                                    labels: {
                                        show: true,
                                        name: {
                                            fontSize: '1.5rem'
                                        },
                                        value: {
                                            fontSize: '1rem'
                                        },
                                        total: {
                                            fontSize: '1.5rem'
                                        }
                                    }
                                }
                            }
                        },
                        legend: {
                            position: 'bottom',
                            labels: {
                                colors: legendColor,
                                useSeriesColors: false
                            }
                        }
                    }
                },
                {
                    breakpoint: 420,
                    options: {
                        chart: {
                            height: 280
                        },
                        legend: {
                            show: false
                        }
                    }
                },
                {
                    breakpoint: 360,
                    options: {
                        chart: {
                            height: 250
                        },
                        legend: {
                            show: false
                        }
                    }
                }
            ]
        };

        if (!donutChart) {
            // If no chart is created, create a new one
            donutChart = new ApexCharts(donutChartEl, donutChartConfig);
            donutChart.render();
        } else {
            // If chart already exists, update the data and re-render
            donutChart.updateOptions({
                labels: allCount.name,
                series: allCount.values
            });
        }
    }
// Donut Chart Region Wise States

// Polar Chart Credit Mix
    let polarChartInstance = null;
    function CreditMixGraph(data) {
        if (!data || !Array.isArray(data.name) || !Array.isArray(data.values)) return;

        const allCount = {
            name: data.name,
            values: data.values.map(val => Number(val)) // convert to numbers
        };

        const polarChart = document.getElementById('creditMaxPolarChart');

        if (polarChart) {
            if (polarChartInstance) {
                // Update the existing chart's data without destroying it
                polarChartInstance.data.labels = allCount.name;
                polarChartInstance.data.datasets[0].data = allCount.values;
                polarChartInstance.update();
            } else {
                // If the chart doesn't exist, create it
                polarChartInstance = new Chart(polarChart, {
                    type: 'polarArea',
                    data: {
                        labels: allCount.name,
                        datasets: [
                            {
                                label: 'Population (millions)',
                                backgroundColor: [purpleColor, yellowColor, orangeColor, oceanBlueColor, greyColor],
                                data: allCount.values,
                                borderWidth: 0
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        animation: {
                            duration: 500
                        },
                        scales: {
                            r: {
                                ticks: {
                                    display: false,
                                    color: labelColor
                                },
                                grid: {
                                    display: false
                                }
                            }
                        },
                        plugins: {
                            tooltip: {
                                rtl: isRtl,
                                backgroundColor: cardColor,
                                titleColor: headingColor,
                                bodyColor: legendColor,
                                borderWidth: 1,
                                borderColor: borderColor
                            },
                            legend: {
                                rtl: isRtl,
                                position: 'right',
                                labels: {
                                    usePointStyle: true,
                                    padding: 25,
                                    boxWidth: 8,
                                    boxHeight: 8,
                                    color: legendColor
                                }
                            }
                        }
                    }
                });
            }
        }
    }
// Polar Chart Credit Mix

// Quarterly Sales Area Chart
// --------------------------------------------------------------------
// function equipmentCostByYear(count){
//     var allCount = (count && count.length !== 0) ? count : [];
//     const equipmentCostByYear = document.querySelector('#equipmentCostYearly'),
//     equipmentCostYearlyConfig = {
//         chart: {
//         height: 90,
//         type: 'area',
//         toolbar: {
//             show: false
//         },
//         sparkline: {
//             enabled: true
//         }
//         },
//         markers: {
//         colors: 'transparent',
//         strokeColors: 'transparent'
//         },
//         grid: {
//         show: false
//         },
//         colors: [config.colors.primary],
//         fill: {
//         type: 'gradient',
//         gradient: {
//             shade: shadeColor,
//             shadeIntensity: 0.8,
//             opacityFrom: 0.6,
//             opacityTo: 0.1
//         }
//         },
//         dataLabels: {
//         enabled: false
//         },
//         stroke: {
//         width: 2,
//         curve: 'smooth'
//         },
//         series: [
//         {
//             data: allCount
//         }
//         ],
//         xaxis: {
//         show: true,
//         lines: {
//             show: false
//         },
//         labels: {
//             show: false
//         },
//         stroke: {
//             width: 0
//         },
//         axisBorder: {
//             show: false
//         }
//         },
//         yaxis: {
//         stroke: {
//             width: 0
//         },
//         show: false
//         },
//         tooltip: {
//         enabled: false
//         }
//     };
//     if (typeof equipmentCostByYear !== undefined && equipmentCostByYear !== null) {
//     const equipmentCostYearly = new ApexCharts(equipmentCostByYear, equipmentCostYearlyConfig);
//     equipmentCostYearly.render();
//     }
// }

function equipmentCostByYear(count){
    var allCount = (count && count.length !== 0) ? count : [];
    const equipmentCostEl = document.querySelector('#equipmentCostYearly');

    // Destroy previous chart
    if (equipmentCostChart) {
        equipmentCostChart.destroy();
    }

    const equipmentCostYearlyConfig = {
        chart: {
            height: 90,
            type: 'area',
            toolbar: { show: false },
            sparkline: { enabled: true }
        },
        markers: {
            colors: 'transparent',
            strokeColors: 'transparent'
        },
        grid: { show: false },
        colors: [config.colors.primary],
        fill: {
            type: 'gradient',
            gradient: {
                shade: shadeColor,
                shadeIntensity: 0.8,
                opacityFrom: 0.6,
                opacityTo: 0.1
            }
        },
        dataLabels: { enabled: false },
        stroke: {
            width: 2,
            curve: 'smooth'
        },
        series: [{ data: allCount }],
        xaxis: {
            show: true,
            labels: { show: false },
            axisBorder: { show: false }
        },
        yaxis: { show: false },
        tooltip: { enabled: false }
    };

    if (equipmentCostEl) {
        equipmentCostChart = new ApexCharts(equipmentCostEl, equipmentCostYearlyConfig);
        equipmentCostChart.render();
    }
}

// Order Received Area Chart
// --------------------------------------------------------------------
// function resolvedTicketYearly(totals, labels){
//     // var allCount = (count && count.length !== 0) ? count : [];
//     const resolvedTicketEl = document.querySelector('#resolvedTicket'),
//       resolvedTicketConfig = {
//         chart: {
//           height: 100,
//           type: 'area',
//           toolbar: { show: false },
//           sparkline: { enabled: true }
//         },
//         markers: {
//           colors: 'transparent',
//           strokeColors: 'transparent'
//         },
//         grid: { show: false },
//         colors: [config.colors.warning],
//         fill: {
//           type: 'gradient',
//           gradient: {
//             shade: 'light',
//             shadeIntensity: 0.8,
//             opacityFrom: 0.6,
//             opacityTo: 0.1
//           }
//         },
//         dataLabels: { enabled: false },
//         stroke: {
//           width: 2,
//           curve: 'smooth'
//         },
//         series: [{
//             name: 'Resolved Tickets',
//             data: totals
//         }],
//          xaxis: {
//             categories: labels,
//             labels: {
//                 show: true,
//                 style: {
//                     colors: '#888',
//                     fontSize: '12px'
//                 }
//             },
//             axisBorder: { show: false },
//             axisTicks: { show: false }
//         },
//         yaxis: { show: false },
//         tooltip: { enabled: true }
//       };
//     if (typeof resolvedTicketEl !== undefined && resolvedTicketEl !== null) {
//       const resolvedTicket = new ApexCharts(resolvedTicketEl, resolvedTicketConfig);
//       resolvedTicket.render();
//     }
// }

function resolvedTicketYearly(totals, labels){
    const resolvedTicketEl = document.querySelector('#resolvedTicket');

    // Destroy previous chart
    if (resolvedTicketChart) {
        resolvedTicketChart.destroy();
    }

    const resolvedTicketConfig = {
        chart: {
            height: 100,
            type: 'area',
            toolbar: { show: false },
            sparkline: { enabled: true }
        },
        markers: {
            colors: 'transparent',
            strokeColors: 'transparent'
        },
        grid: { show: false },
        colors: [config.colors.warning],
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'light',
                shadeIntensity: 0.8,
                opacityFrom: 0.6,
                opacityTo: 0.1
            }
        },
        dataLabels: { enabled: false },
        stroke: {
            width: 2,
            curve: 'smooth'
        },
        series: [{
            name: 'Resolved Tickets',
            data: totals
        }],
        xaxis: {
            categories: labels,
            labels: {
                show: true,
                style: {
                    colors: '#888',
                    fontSize: '12px'
                }
            },
            axisBorder: { show: false },
            axisTicks: { show: false }
        },
        yaxis: { show: false },
        tooltip: { enabled: true }
    };

    if (resolvedTicketEl) {
        resolvedTicketChart = new ApexCharts(resolvedTicketEl, resolvedTicketConfig);
        resolvedTicketChart.render();
    }
}

