!function(c){function e(t){if(n[t])return n[t].exports;var s=n[t]={i:t,l:!1,exports:{}};return c[t].call(s.exports,s,s.exports,e),s.l=!0,s.exports}var n={};e.m=c,e.c=n,e.d=function(c,n,t){e.o(c,n)||Object.defineProperty(c,n,{configurable:!1,enumerable:!0,get:t})},e.n=function(c){var n=c&&c.__esModule?function(){return c.default}:function(){return c};return e.d(n,"a",n),n},e.o=function(c,e){return Object.prototype.hasOwnProperty.call(c,e)},e.p="",e(e.s=0)}([function(c,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});n(1)},function(c,e,n){"use strict";var t=n(2);!function(c){function e(){return i("div",{className:"ns-container"},i("div",{className:"ns-wrapper"},i("form",{className:"ns-form "+n.class,id:"ns-form",method:"post",name:"ns-form"},m(),v(),i("div",{className:"ns-group form-group"},h(s),i("input",{type:"text",name:"ns-"+s.name,class:"ns-input ns-email "+s.class||"",id:"ns-"+s.id,placeholder:s.placeholder})),i("div",{className:"ns-action"},i("input",{type:"submit",name:"ns-"+a.name,className:"ns-submit "+a.class,value:a.value,onClick:function(c){c.preventDefault()}})))))}var n=NS_FORM.html.form,s=NS_FORM.html.form.email,l=NS_FORM.html.form.firstname,r=NS_FORM.html.form.lastname,a=NS_FORM.html.form.submit,o=c.blocks.registerBlockType,i=c.element.createElement,__=c.i18n.__,u=c.editor.InspectorControls,h=function(c){var e=[];return e.push(i("label",{className:"form-label",for:"ns-"+c.id},c.label)),e},v=function(){var c=r||{};if(0!=Object.keys(c).length){var e=[];return e.push(i("div",{className:"ns-group form-group"},h(c),i("input",{type:"text",name:"ns-"+c.name,class:"ns-input ns-lastname "+c.class||"",id:"ns-"+c.id,placeholder:c.placeholder}))),e}},m=function(){var c=l||{};if(0!=Object.keys(c).length){var e=[];return e.push(i("div",{className:"ns-group form-group"},h(c),i("input",{type:"text",name:"ns-"+c.name,class:"ns-input ns-firstname "+c.class||"",id:"ns-"+c.id,placeholder:c.placeholder}))),e}};o("notify-subscribers/notify-subscribers",{title:__("NS FORM"),category:"widgets",icon:t.a,supports:{html:!1},edit:function(c){var n=e();return[[i(u,{},i("hr"),i("a",{href:NS_FORM.settings,target:"_blank"},i("strong",{},__("Advanced Settings"))))],n]},save:function(c){return null}})}(window.wp)},function(c,e,n){"use strict";var t=wp.element.createElement("svg",{version:"1.1",width:"16pt",heght:"16pt",x:"0px",y:"0px",viewBox:"0 0 828 1090.9"},wp.element.createElement("path",{class:"ns-fill-1",d:"M465.7,362.3L465.7,362.3c-85.4-85.5-99.2-219.2-32.9-320.3H93.3C41.8,42,0,83.8,0,135.3v0v184.3 c18.9-48.7,67.7-65.9,99.6-71.3L88,248.4c0,0,10-25.4,36.2-25.4s33.6,24.4,33.6,24.4l-14.8,0.2c39.6,5.8,111.4,30.2,111.4,116.9 v124.4c0,54.2,40.9,42.2,64.6,109.3c6.9,19.5,7.8,56.9-30.1,56.9H0v47.6C0,754.2,41.8,796,93.3,796c0,0,0,0,0,0h567.4 c51.5,0,93.3-41.8,93.3-93.3c0,0,0,0,0,0V413.1C656.8,458.4,541.6,438.1,465.7,362.3z M123.7,727.8c-33,0-59.7-26.7-59.7-59.7h119.4 C183.4,701.1,156.7,727.8,123.7,727.8z M303.9,336.6c-0.2,1.7-0.2,3.3-0.5,5c-0.6,4.6-3.7,7.5-7.9,7.4c-4.4-0.1-7.6-3.2-7.7-8.1 c-0.2-7.5,0.3-15-0.4-22.4c-4.9-47-41.8-84.3-88.7-89.8l-2.5-0.3c-6-0.8-9.1-3.9-8.6-8.8s4.6-8.1,10.7-6.8c11.2,2.5,22.8,4.3,33,9.1 c45.3,21.1,69.6,57.1,72.6,107.2c0.2,2.5-0.1,5-0.2,7.5L303.9,336.6z M363.6,350.3c-3,1.4-6,3.8-9,3.9c-4.5,0.2-6.9-4.1-6.4-9.9 c1.7-21,0.1-41.7-6.5-61.7c-19.6-59.6-60.2-96.7-121.2-111.3c-5.7-1.3-11.5-2-17.2-2.8c-4.3-0.6-8.4-1.3-9.8-6.2 c-1.3-4.6,1.4-7.5,4.7-10l19.9,1.8c8.1,2.4,16.4,4.1,24.3,7.2c71.5,27.5,112.2,79.2,121.4,155.4c0.8,6.2,0.8,12.5,1.2,18.8 L363.6,350.3z M129.6,830.1v138.6h-9.3l-78.8-84.1v81.7H13.7V827.7h9.1l79,83.5v-81.1H129.6z M282.6,848 c14.2,13.6,21.2,30.3,21.2,50.2c0,19.9-7.1,36.7-21.2,50.2c-14.2,13.5-31.3,20.3-51.3,20.3s-37.1-6.8-51.2-20.3 c-14-13.5-21-30.3-21-50.2s7-36.7,21-50.2s31-20.3,51.2-20.3S268.5,834.4,282.6,848z M200.1,866c-8.2,8.4-12.4,19.1-12.4,32.2 c0,13.2,4.1,24,12.3,32.3c8.2,8.3,18.7,12.5,31.4,12.5c12.5,0,22.9-4.2,31.2-12.6c8.3-8.4,12.5-19.1,12.5-32.2 c0-13.1-4.2-23.8-12.5-32.2c-8.3-8.4-18.7-12.6-31.2-12.6C218.8,853.4,208.4,857.6,200.1,866L200.1,866z M432.7,855.3H389v111h-27.8 v-111h-43.5v-25.2h115.1L432.7,855.3z M485.1,966.2h-27.8V830.1h27.8V966.2z M611.9,855.3h-61.7v34h50.5v25.2h-50.5v51.8h-27.8 V830.1h89.5V855.3z M701.7,912.6v53.6h-27.8v-53.4l-47-82.7h30.9l29.9,54l30.1-54h30.7L701.7,912.6z"}),wp.element.createElement("path",{class:"ns-fill-2",d:"M646,0C545.5,0.1,464.1,81.6,464,182c0,100.3,81.6,182,182,182c100.5-0.1,181.9-81.5,182-182 C828,81.6,746.3,0,646,0z M53.2,1001.6c4.8,2.7,8.9,6.5,11.9,11.1l-7.8,5.9c-5-7.6-11.9-11.4-20.7-11.4c-4.1-0.1-8.1,1.1-11.4,3.4 c-3.1,2.3-4.8,5.9-4.7,9.7c0,1.8,0.3,3.6,1,5.2c0.8,1.6,1.9,3,3.4,4.1c1.3,1.1,2.8,2.1,4.3,2.9c1.3,0.7,3.2,1.7,5.9,3l10,4.8 c7.1,3.4,12.4,7,15.9,10.8c3.5,4,5.4,9.1,5.2,14.4c0.2,7-2.8,13.8-8.2,18.2c-5.5,4.7-12.5,7-21,7c-6.8,0.1-13.5-1.7-19.3-5.2 c-5.8-3.5-10.7-8.4-14.1-14.3l8-5.9c6.8,10.3,15.2,15.5,25.2,15.5c5.4,0,9.8-1.4,13.2-4.1c3.4-2.6,5.2-6.7,5.1-11 c0-3.8-1.2-6.8-3.5-8.9s-6.2-4.4-11.6-7l-10.2-4.8c-6.4-3.1-11.4-6.5-15-10.2s-5.4-8.4-5.4-14.1c-0.2-6.6,2.8-13,8-17.1 c5.3-4.3,11.8-6.5,19.3-6.5C42.5,997.3,48.2,998.8,53.2,1001.6z M140.7,1062.8c0,8.4-2.6,15.2-7.9,20.4c-5.2,5.2-12.3,8-19.7,7.8 c-7.9,0-14.6-2.6-19.8-7.8s-7.9-12-7.9-20.4v-40.2h10.4v40.9c0,5.4,1.6,9.7,4.9,12.9c3.3,3.2,7.7,4.9,12.3,4.8 c4.5,0.1,8.9-1.6,12.2-4.9c3.2-3.2,4.9-7.5,4.9-12.8v-40.9h10.6L140.7,1062.8z M221.8,1031c6.3,6.7,9.4,15,9.4,25 s-3.1,18.3-9.3,24.8c-6.2,6.7-14.1,10-23.6,10c-5.1,0-10.1-1.1-14.7-3.2c-4.3-1.9-8-5.1-10.7-9v10.7H163V986.4h10.6v46 c2.7-3.6,6.3-6.5,10.5-8.4c4.4-2,9.2-3,14.1-3C207.7,1021,215.6,1024.4,221.8,1031z M213.7,1074c4.5-4.7,6.7-10.8,6.7-18.1 c0-7.2-2.3-13.2-6.8-18c-4.4-4.7-10.5-7.3-16.9-7.1c-6.1-0.1-12,2.2-16.4,6.4c-4.5,4.3-6.8,10.6-6.8,18.8s2.3,14.5,6.8,18.7 c4.4,4.2,10.3,6.5,16.4,6.4C203.1,1081.3,209.3,1078.7,213.7,1074L213.7,1074z M292.3,1031.6l-6.4,6.6c-4.7-4.9-10.2-7.4-16.5-7.4 c-2.8-0.1-5.6,0.6-8,2.2c-2,1.4-3.2,3.7-3.1,6.2c-0.1,2.1,0.9,4,2.5,5.3c2.6,1.8,5.4,3.3,8.4,4.4l6.2,2.6c6.2,2.7,10.7,5.5,13.5,8.4 c2.8,3.1,4.3,7.1,4.2,11.3c0,6.2-2.3,11-6.8,14.5c-4.5,3.4-10.1,5.1-16.7,5.2c-10.9,0-19.6-4.3-26.1-13l6.7-7 c6.5,6.9,12.9,10.3,19.2,10.3c3.2,0.1,6.4-0.8,9.1-2.5c2.3-1.5,3.7-4.1,3.6-6.9c0.1-2.4-0.9-4.6-2.7-6.1c-2.8-1.9-5.8-3.4-8.9-4.6 l-6.4-2.8c-5.6-2.4-9.7-4.9-12.5-7.7c-2.8-2.9-4.3-6.8-4.1-10.8c0-5.9,2.2-10.4,6.4-13.7c4.3-3.3,9.6-4.9,16-4.9 C279.1,1021.1,286.6,1024.6,292.3,1031.6z M369.8,1035.6l-7.6,6c-5.4-7.2-12-10.8-19.9-10.8c-6.6-0.2-12.9,2.5-17.4,7.3 c-9.2,10.1-9.2,25.7,0,35.8c4.5,4.8,10.8,7.4,17.4,7.3c7.9,0,14.5-3.6,19.8-10.7l7.6,5.9c-6.5,9.7-15.6,14.6-27.4,14.6 c-19.3,0.3-35.2-15-35.5-34.3c-0.3-19.3,15-35.2,34.3-35.5c0.4,0,0.8,0,1.2,0C354.1,1021,363.3,1025.9,369.8,1035.6z M423.2,1022.6 v9.3h-4c-5.4-0.1-10.7,1.7-14.8,5.2c-4.1,3.5-6.2,8.3-6.2,14.4v37.9h-10.6v-66.8h9.9v9.6c5-6.8,11.9-10.1,20.7-10.1 C419.9,1022.1,421.5,1022.2,423.2,1022.6z M448.2,991.6c3,2.9,3.1,7.7,0.2,10.8c0,0-0.1,0.1-0.1,0.1c-1.5,1.5-3.5,2.3-5.6,2.2 c-2.1,0.1-4.2-0.7-5.7-2.2c-3-3-3-7.9,0-10.9c0,0,0,0,0,0c1.5-1.5,3.6-2.3,5.7-2.3C444.8,989.3,446.7,990.2,448.2,991.6z M447.9,1089.4h-10.6v-66.8h10.6V1089.4z M529.8,1031c6.3,6.7,9.4,15,9.4,25s-3.1,18.3-9.3,24.8c-6.2,6.7-14.1,10-23.6,10 c-5.1,0-10.1-1.1-14.7-3.2c-4.3-1.9-8-5.1-10.7-9v10.7h-9.9V986.4h10.6v46c2.7-3.6,6.4-6.5,10.5-8.4c4.4-2,9.2-3,14.1-3 C515.7,1021,523.6,1024.4,529.8,1031z M521.7,1074c4.5-4.7,6.7-10.8,6.7-18.1c0-7.2-2.3-13.2-6.8-18c-4.4-4.7-10.6-7.3-17-7.1 c-6.1-0.1-12,2.2-16.4,6.4c-4.5,4.3-6.8,10.6-6.8,18.8c0,8.2,2.3,14.5,6.8,18.7c4.4,4.2,10.3,6.5,16.4,6.4 C511,1081.3,517.3,1078.7,521.7,1074L521.7,1074z M616.8,1059.2h-52.7c0.4,6.1,3.2,11.8,7.8,15.9c4.6,4,10.6,6.2,16.7,6 c7.6,0,14.4-3,20.4-9.1l6.2,7.1c-6.8,7.6-16.6,11.8-26.8,11.7c-10.1,0-18.5-3.3-25.2-10c-6.8-6.7-10.2-14.9-10.2-24.8 c-0.2-9.3,3.4-18.2,9.9-24.8c6.3-6.7,15.1-10.3,24.3-10.1c8.7,0,15.9,2.8,21.7,8.5c5.8,5.7,8.7,12.9,8.7,21.7 C617.6,1053.9,617.3,1056.6,616.8,1059.2z M572.3,1035.9c-4.2,3.6-6.9,8.5-7.8,13.9h42.3c-0.1-5.9-2-10.6-5.8-14.1 c-3.9-3.5-8.9-5.3-14.1-5.1C581.5,1030.6,576.3,1032.5,572.3,1035.9L572.3,1035.9z M671.6,1022.6v9.3h-4c-5.4-0.1-10.7,1.7-14.8,5.2 c-4.1,3.5-6.2,8.3-6.2,14.4v37.9h-10.6v-66.8h9.9v9.6c5-6.8,11.9-10.2,20.7-10.1C668.3,1022,670,1022.2,671.6,1022.6z M728.3,1031.6 l-6.4,6.6c-4.8-4.9-10.2-7.4-16.5-7.4c-2.8-0.1-5.6,0.6-8,2.2c-2,1.4-3.2,3.7-3.1,6.2c-0.1,2.1,0.9,4,2.5,5.3 c2.6,1.8,5.4,3.3,8.4,4.4l6.2,2.6c6.2,2.7,10.7,5.5,13.5,8.4c2.8,3.1,4.3,7.1,4.2,11.3c0,6.2-2.3,11-6.8,14.5 c-4.5,3.4-10.1,5.1-16.7,5.2c-10.9,0-19.6-4.3-26.1-13l6.7-7c6.5,6.9,12.9,10.3,19.2,10.3c3.2,0.1,6.4-0.8,9.1-2.5 c2.3-1.5,3.7-4.1,3.6-6.9c0.1-2.4-0.9-4.6-2.7-6.1c-2.8-1.9-5.8-3.5-8.9-4.6l-6.4-2.8c-5.6-2.4-9.7-4.9-12.5-7.7 c-2.8-2.9-4.3-6.8-4.1-10.8c0-5.9,2.2-10.4,6.4-13.7c4.3-3.3,9.6-4.9,16-4.9C715.2,1021.1,722.6,1024.6,728.3,1031.6z"}));e.a=t}]);