/*********************************************************************************/
/* Money_day                                                                     */
/*********************************************************************************/
window.addEventListener('load', () => {
  let money_day_chart = {
    graphset: [
      // 제목
      {
        type: 'area',
        title: {
          text: 'Money Chart',
          color: '#5D7D9A',
          align: 'left',
          padding: '30 0 0 35',
          fontSize: '30px'
        },
        // 서브 제목
        subtitle: {
          text: 'please check your money',
          color: '#5D7D9A',
          fontWeight: 300,
          align: 'left',
          padding: '35 0 0 35',
          fontSize: '15px'
        },
        // 모르겠담
        tooltip: {
          visible: false
        },
        /* 그래프 위에 마우스 올리면 뜨는 팝업창 */
        crosshairX: {
          plotLabel: {
            fontColor: '#333',
            backgroundColor: '#fff',
            borderRadius: 5,
            borderColor: '#EEE',
            padding: 10
          },
          // 숫자 띄울 시 더 예쁘게 보이기 위함
          'scaleLabel': {
            alpha: 0,
            text: '%v',
            transform: {
              type: 'date',
              all: '%M %d, %Y<br>%g:%i %a'
            },
            fontFamily: 'Georgia'
          }
        },
        /* 그래프 제목 위치 margin */
        plotarea: {
          margin: '110 40 60 80'
        },
        // 모르겠담 - 없어도 달라지지 않음
        _legend: {
          layout: '2x2',
          align: 'right',
          'verticalAlign': 'top',
          margin: '10 40 0 0',
          padding: '5px',
          borderRadius: '5px',
          header: {
            text: 'Legend',
            color: '#5D7D9A',
            padding: '10px'
          },
          item: {
            color: '#5D7D9A'
          }
        },
        /** x축 */
        scaleX: {
          labels: ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'],
          // 이건 뭐지? - 없어도 달라지지 않음
          label: {
            color: '#6C6C6C'
          },
          lineColor: '#D8D8D8',
          // x축 막대기색
          tick: {
            lineColor: '#D8D8D8'
          },
          // x축 글자색
          item: {
            color: '#6C6C6C'
          },
          // x축 밑 라벨 조정
          label: {
            padding: '20 0 0 0',
            text: 'Day',
            color: '#6C6C6C'
          }
        },
        // 그래프 관련
        plot: {
          // 투명도
          alphaArea: 0.4,
          // true일시 더 확실하게 크게 보이는 것 같은데 수치가 정확하게 나오지는 않음
          stacked: false,
          // 그래프 크로스헤어 크기
          marker: {
            size: 4
          }
        },
        /** Y축  */
        scaleY: {
          maxItems: 8,
          // Y축 세로선 색
          lineColor: '#D8D8D8',
          // y축 크기 배분
          values: '0:500:100',
          guide: {
            'lineStyle': 'solid'
          },
          // y축 막대기 색
          tick: {
            lineColor: '#D8D8D8'
          },
          // y축 글자색
          item: {
            color: '#6C6C6C'
          },
          // y축 왼쪽 라벨 조절
          label: {
            padding: '20 0 0 0',
            text: '( unit : 10000 Won )',
            color: '#6C6C6C'
          }
        },
        // 값 입력
        series: [
          {
            values: [45,40,46,40,38,45,50],
            lineColor: '#94DBF9',
            backgroundColor: '#94DBF9',
            marker: {
              backgroundColor: '#94DBF9',
              borderColor: '#94DBF9'
            }
          }
        ]
      }
    ]
  };
 
  // render chart
  zingchart.render({
    id: 'money_day',
    data: money_day_chart,
    height: '100%',
    width: '100%'
  });
});


/*********************************************************************************/
/* Car_day                                                                       */
/*********************************************************************************/
window.addEventListener('load', () => {
  let Car_day_chart = {
    graphset: [
      // 제목
      {
        type: 'area',
        title: {
          text: 'Car Chart',
          color: '#5D7D9A',
          align: 'left',
          padding: '30 0 0 35',
          fontSize: '30px'
        },
        // 서브 제목
        subtitle: {
          text: 'please check your money',
          color: '#5D7D9A',
          fontWeight: 300,
          align: 'left',
          padding: '35 0 0 35',
          fontSize: '15px'
        },
        // 모르겠담
        tooltip: {
          visible: false
        },
        /* 그래프 위에 마우스 올리면 뜨는 팝업창 */
        crosshairX: {
          plotLabel: {
            fontColor: '#333',
            backgroundColor: '#fff',
            borderRadius: 5,
            borderColor: '#EEE',
            padding: 10
          },
          // 숫자 띄울 시 더 예쁘게 보이기 위함
          'scaleLabel': {
            alpha: 0,
            text: '%v',
            transform: {
              type: 'date',
              all: '%M %d, %Y<br>%g:%i %a'
            },
            fontFamily: 'Georgia'
          }
        },
        /* 그래프 제목 위치 margin */
        plotarea: {
          margin: '110 40 60 80'
        },
        // 모르겠담 - 없어도 달라지지 않음
        _legend: {
          layout: '2x2',
          align: 'right',
          'verticalAlign': 'top',
          margin: '10 40 0 0',
          padding: '5px',
          borderRadius: '5px',
          header: {
            text: 'Legend',
            color: '#5D7D9A',
            padding: '10px'
          },
          item: {
            color: '#5D7D9A'
          }
        },
        /** x축 */
        scaleX: {
          labels: ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'],
          // 이건 뭐지? - 없어도 달라지지 않음
          label: {
            color: '#6C6C6C'
          },
          lineColor: '#D8D8D8',
          // x축 막대기색
          tick: {
            lineColor: '#D8D8D8'
          },
          // x축 글자색
          item: {
            color: '#6C6C6C'
          },
          // x축 밑 라벨 조정
          label: {
            padding: '20 0 0 0',
            text: 'Day',
            color: '#6C6C6C'
          }
        },
        // 그래프 관련
        plot: {
          // 투명도
          alphaArea: 0.4,
          // true일시 더 확실하게 크게 보이는 것 같은데 수치가 정확하게 나오지는 않음
          stacked: false,
          // 그래프 크로스헤어 크기
          marker: {
            size: 4
          }
        },
        /** Y축  */
        scaleY: {
          maxItems: 8,
          // Y축 세로선 색
          lineColor: '#D8D8D8',
          // y축 크기 배분
          values: '0:500:100',
          guide: {
            'lineStyle': 'solid'
          },
          // y축 막대기 색
          tick: {
            lineColor: '#D8D8D8'
          },
          // y축 글자색
          item: {
            color: '#6C6C6C'
          },
          // y축 왼쪽 라벨 조절
          label: {
            padding: '20 0 0 0',
            text: '( unit : 10000 Won )',
            color: '#6C6C6C'
          }
        },
        // 값 입력
        series: [
          {
            values: [45,40,46,40,38,45,50],
            lineColor: '#94DBF9',
            backgroundColor: '#94DBF9',
            marker: {
              backgroundColor: '#94DBF9',
              borderColor: '#94DBF9'
            }
          }
        ]
      }
    ]
  };
 
  // render chart
  zingchart.render({
    id: 'car_day',
    data: Car_day_chart,
    height: '100%',
    width: '100%'
  });
});


/*********************************************************************************/
/* Money_month                                                                   */
/*********************************************************************************/
window.addEventListener('load', () => {
  let money_month_chart = {
    graphset: [
      // 제목
      {
        type: 'area',
        title: {
          text: 'Money Chart',
          color: '#5D7D9A',
          align: 'left',
          padding: '30 0 0 35',
          fontSize: '30px'
        },
        // 서브 제목
        subtitle: {
          text: 'please check your money',
          color: '#5D7D9A',
          fontWeight: 300,
          align: 'left',
          padding: '35 0 0 35',
          fontSize: '15px'
        },
        // 모르겠담
        tooltip: {
          visible: false
        },
        /* 그래프 위에 마우스 올리면 뜨는 팝업창 */
        crosshairX: {
          plotLabel: {
            fontColor: '#333',
            backgroundColor: '#fff',
            borderRadius: 5,
            borderColor: '#EEE',
            padding: 10
          },
          // 숫자 띄울 시 더 예쁘게 보이기 위함
          'scaleLabel': {
            alpha: 0,
            text: '%v',
            transform: {
              type: 'date',
              all: '%M %d, %Y<br>%g:%i %a'
            },
            fontFamily: 'Georgia'
          }
        },
        /* 그래프 제목 위치 margin */
        plotarea: {
          margin: '110 40 60 80'
        },
        // 모르겠담 - 없어도 달라지지 않음
        _legend: {
          layout: '2x2',
          align: 'right',
          'verticalAlign': 'top',
          margin: '10 40 0 0',
          padding: '5px',
          borderRadius: '5px',
          header: {
            text: 'Legend',
            color: '#5D7D9A',
            padding: '10px'
          },
          item: {
            color: '#5D7D9A'
          }
        },
        /** x축 */
        scaleX: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nob', 'Dec'],
          // 이건 뭐지? - 없어도 달라지지 않음
          label: {
            color: '#6C6C6C'
          },
          lineColor: '#D8D8D8',
          // x축 막대기색
          tick: {
            lineColor: '#D8D8D8'
          },
          // x축 글자색
          item: {
            color: '#6C6C6C'
          },
          // x축 밑 라벨 조정
          label: {
            padding: '20 0 0 0',
            text: 'Month',
            color: '#6C6C6C'
          }
        },
        // 그래프 관련
        plot: {
          // 투명도
          alphaArea: 0.4,
          // true일시 더 확실하게 크게 보이는 것 같은데 수치가 정확하게 나오지는 않음
          stacked: false,
          // 그래프 크로스헤어 크기
          marker: {
            size: 4
          }
        },
        /** Y축  */
        scaleY: {
          maxItems: 8,
          // Y축 세로선 색
          lineColor: '#D8D8D8',
          // y축 크기 배분
          values: '0:500:100',
          guide: {
            'lineStyle': 'solid'
          },
          // y축 막대기 색
          tick: {
            lineColor: '#D8D8D8'
          },
          // y축 글자색
          item: {
            color: '#6C6C6C'
          },
          // y축 왼쪽 라벨 조절
          label: {
            padding: '20 0 0 0',
            text: '( unit : 10000 Won )',
            color: '#6C6C6C'
          }
        },
        // 값 입력
        series: [
          {
            values: [45,40,46,40,38,45,50,24,14,26,38,46],
            lineColor: '#94DBF9',
            backgroundColor: '#94DBF9',
            marker: {
              backgroundColor: '#94DBF9',
              borderColor: '#94DBF9'
            }
          }
        ]
      }
    ]
  };
 
  // render chart
  zingchart.render({
    id: 'money_month',
    data: money_month_chart,
    height: '100%',
    width: '100%'
  });
});


/*********************************************************************************/
/* Car_month                                                                     */
/*********************************************************************************/
window.addEventListener('load', () => {

  let car_month_chart = {
    graphset: [
      // 제목
      {
        type: 'area',
        title: {
          text: 'Car Chart',
          color: '#5D7D9A',
          align: 'left',
          padding: '30 0 0 35',
          fontSize: '30px'
        },
        // 서브 제목
        subtitle: {
          text: 'please check your car',
          color: '#5D7D9A',
          fontWeight: 300,
          align: 'left',
          padding: '35 0 0 35',
          fontSize: '15px'
        },
        // 모르겠담
        tooltip: {
          visible: false
        },
        /* 그래프 위에 마우스 올리면 뜨는 팝업창 */
        crosshairX: {
          plotLabel: {
            fontColor: '#333',
            backgroundColor: '#fff',
            borderRadius: 5,
            borderColor: '#EEE',
            padding: 10
          },
          // 숫자 띄울 시 더 예쁘게 보이기 위함
          'scaleLabel': {
            alpha: 0,
            text: '%v',
            transform: {
              type: 'date',
              all: '%M %d, %Y<br>%g:%i %a'
            },
            fontFamily: 'Georgia'
          }
        },
        /* 그래프 위치 margin */
        plotarea: {
          margin: '120 40 60 80'
        },
        // 모르겠담 - 없어도 달라지지 않음
        _legend: {
          layout: '2x2',
          align: 'right',
          'verticalAlign': 'top',
          margin: '10 40 0 0',
          padding: '5px',
          borderRadius: '5px',
          header: {
            text: 'Legend',
            color: '#5D7D9A',
            padding: '10px'
          },
          item: {
            color: '#5D7D9A'
          }
        },
        /** x축 */
        scaleX: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nob', 'Dec'],
          // 이건 뭐지? - 없어도 달라지지 않음
          label: {
            color: '#6C6C6C'
          },
          lineColor: '#D8D8D8',
          // x축 막대기색
          tick: {
            lineColor: '#D8D8D8'
          },
          // x축 글자색
          item: {
            color: '#6C6C6C'
          },
          // x축 밑 라벨 조정
          label: {
            padding: '20 0 0 0',
            text: 'Month',
            color: '#6C6C6C'
          }
        },
        // 그래프 관련
        plot: {
          // 투명도
          alphaArea: 0.4,
          // true일시 더 확실하게 크게 보이는 것 같은데 수치가 정확하게 나오지는 않음
          stacked: false,
          // 그래프 크로스헤어 크기
          marker: {
            size: 4
          }
        },
        /** Y축  */
        scaleY: {
          maxItems: 8,
          // Y축 세로선 색
          lineColor: '#D8D8D8',
          // y축 크기 배분
          values: '0:500:100',
          guide: {
            'lineStyle': 'solid'
          },
          // y축 막대기 색
          tick: {
            lineColor: '#D8D8D8'
          },
          // y축 글자색
          item: {
            color: '#6C6C6C'
          },
          // y축 왼쪽 라벨 조절
          label: {
            padding: '20 0 0 0',
            text: '( unit : 10000 Won )',
            color: '#6C6C6C'
          }
        },
        // 값 입력
        series: [
          {
            values: [100,40,46,40,38,45,50,24,14,26,38,46],
            lineColor: '#94DBF9',
            backgroundColor: '#94DBF9',
            marker: {
              backgroundColor: '#94DBF9',
              borderColor: '#94DBF9'
            }
          }
        ]
      }
    ]
  };
 
  // render chart
  zingchart.render({
    id: 'car_month',
    data: car_month_chart,
    height: '100%',
    width: '100%'
  });
});


/*********************************************************************************/
/* Money_Year                                                                    */
/*********************************************************************************/
window.addEventListener('load', () => {
  let money_year_chart = {
    graphset: [
      // 제목
      {
        type: 'area',
        title: {
          text: 'Money Chart',
          color: '#5D7D9A',
          align: 'left',
          padding: '30 0 0 35',
          fontSize: '30px'
        },
        // 서브 제목
        subtitle: {
          text: 'please check your money',
          color: '#5D7D9A',
          fontWeight: 300,
          align: 'left',
          padding: '35 0 0 35',
          fontSize: '15px'
        },
        // 모르겠담
        tooltip: {
          visible: false
        },
        /* 그래프 위에 마우스 올리면 뜨는 팝업창 */
        crosshairX: {
          plotLabel: {
            fontColor: '#333',
            backgroundColor: '#fff',
            borderRadius: 5,
            borderColor: '#EEE',
            padding: 10
          },
          // 숫자 띄울 시 더 예쁘게 보이기 위함
          'scaleLabel': {
            alpha: 0,
            text: '%v',
            transform: {
              type: 'date',
              all: '%M %d, %Y<br>%g:%i %a'
            },
            fontFamily: 'Georgia'
          }
        },
        /* 그래프 제목 위치 margin */
        plotarea: {
          margin: '110 40 60 80'
        },
        // 모르겠담 - 없어도 달라지지 않음
        _legend: {
          layout: '2x2',
          align: 'right',
          'verticalAlign': 'top',
          margin: '10 40 0 0',
          padding: '5px',
          borderRadius: '5px',
          header: {
            text: 'Legend',
            color: '#5D7D9A',
            padding: '10px'
          },
          item: {
            color: '#5D7D9A'
          }
        },
        /** x축 */
        scaleX: {
          labels: ['2017','2018','2019','2020'],
          // 이건 뭐지? - 없어도 달라지지 않음
          label: {
            color: '#6C6C6C'
          },
          lineColor: '#D8D8D8',
          // x축 막대기색
          tick: {
            lineColor: '#D8D8D8'
          },
          // x축 글자색
          item: {
            color: '#6C6C6C'
          },
          // x축 밑 라벨 조정
          label: {
            padding: '20 0 0 0',
            text: 'Month',
            color: '#6C6C6C'
          }
        },
        // 그래프 관련
        plot: {
          // 투명도
          alphaArea: 0.4,
          // true일시 더 확실하게 크게 보이는 것 같은데 수치가 정확하게 나오지는 않음
          stacked: false,
          // 그래프 크로스헤어 크기
          marker: {
            size: 4
          }
        },
        /** Y축  */
        scaleY: {
          maxItems: 8,
          // Y축 세로선 색
          lineColor: '#D8D8D8',
          // y축 크기 배분
          values: '0:500:100',
          guide: {
            'lineStyle': 'solid'
          },
          // y축 막대기 색
          tick: {
            lineColor: '#D8D8D8'
          },
          // y축 글자색
          item: {
            color: '#6C6C6C'
          },
          // y축 왼쪽 라벨 조절
          label: {
            padding: '20 0 0 0',
            text: '( unit : 10000 Won )',
            color: '#6C6C6C'
          }
        },
        // 값 입력
        series: [
          {
            values: [45,40,46,40],
            lineColor: '#94DBF9',
            backgroundColor: '#94DBF9',
            marker: {
              backgroundColor: '#94DBF9',
              borderColor: '#94DBF9'
            }
          }
        ]
      }
    ]
  };
 
  // render chart
  zingchart.render({
    id: 'money_year',
    data: money_year_chart,
    height: '100%',
    width: '100%'
  });
});

/*********************************************************************************/
/* Car_Year                                                                    */
/*********************************************************************************/
window.addEventListener('load', () => {
  let Car_year_chart = {
    graphset: [
      // 제목
      {
        type: 'area',
        title: {
          text: 'Car Chart',
          color: '#5D7D9A',
          align: 'left',
          padding: '30 0 0 35',
          fontSize: '30px'
        },
        // 서브 제목
        subtitle: {
          text: 'please check your car',
          color: '#5D7D9A',
          fontWeight: 300,
          align: 'left',
          padding: '35 0 0 35',
          fontSize: '15px'
        },
        // 모르겠담
        tooltip: {
          visible: false
        },
        /* 그래프 위에 마우스 올리면 뜨는 팝업창 */
        crosshairX: {
          plotLabel: {
            fontColor: '#333',
            backgroundColor: '#fff',
            borderRadius: 5,
            borderColor: '#EEE',
            padding: 10
          },
          // 숫자 띄울 시 더 예쁘게 보이기 위함
          'scaleLabel': {
            alpha: 0,
            text: '%v',
            transform: {
              type: 'date',
              all: '%M %d, %Y<br>%g:%i %a'
            },
            fontFamily: 'Georgia'
          }
        },
        /* 그래프 제목 위치 margin */
        plotarea: {
          margin: '110 40 60 80'
        },
        // 모르겠담 - 없어도 달라지지 않음
        _legend: {
          layout: '2x2',
          align: 'right',
          'verticalAlign': 'top',
          margin: '10 40 0 0',
          padding: '5px',
          borderRadius: '5px',
          header: {
            text: 'Legend',
            color: '#5D7D9A',
            padding: '10px'
          },
          item: {
            color: '#5D7D9A'
          }
        },
        /** x축 */
        scaleX: {
          labels: ['2017','2018','2019','2020'],
          // 이건 뭐지? - 없어도 달라지지 않음
          label: {
            color: '#6C6C6C'
          },
          lineColor: '#D8D8D8',
          // x축 막대기색
          tick: {
            lineColor: '#D8D8D8'
          },
          // x축 글자색
          item: {
            color: '#6C6C6C'
          },
          // x축 밑 라벨 조정
          label: {
            padding: '20 0 0 0',
            text: 'Month',
            color: '#6C6C6C'
          }
        },
        // 그래프 관련
        plot: {
          // 투명도
          alphaArea: 0.4,
          // true일시 더 확실하게 크게 보이는 것 같은데 수치가 정확하게 나오지는 않음
          stacked: false,
          // 그래프 크로스헤어 크기
          marker: {
            size: 4
          }
        },
        /** Y축  */
        scaleY: {
          maxItems: 8,
          // Y축 세로선 색
          lineColor: '#D8D8D8',
          // y축 크기 배분
          values: '0:500:100',
          guide: {
            'lineStyle': 'solid'
          },
          // y축 막대기 색
          tick: {
            lineColor: '#D8D8D8'
          },
          // y축 글자색
          item: {
            color: '#6C6C6C'
          },
          // y축 왼쪽 라벨 조절
          label: {
            padding: '20 0 0 0',
            text: '( unit : 10000 Won )',
            color: '#6C6C6C'
          }
        },
        // 값 입력
        series: [
          {
            values: [45,40,46,40],
            lineColor: '#94DBF9',
            backgroundColor: '#94DBF9',
            marker: {
              backgroundColor: '#94DBF9',
              borderColor: '#94DBF9'
            }
          }
        ]
      }
    ]
  };
 
  // render chart
  zingchart.render({
    id: 'car_year',
    data: Car_year_chart,
    height: '100%',
    width: '100%'
  });
});