/**
 * 弹出式提示框，默认1.8秒自动消失
 * @param message 提示信息
 * @param style 提示样式，有alert-success、alert-danger、alert-warning、alert-info
 * @param time 消失时间
 */
var prompt = function (message, style, time)
{
    style = (style === undefined) ? 'alert-success' : style;
    time = (time === undefined) ? 1800 : time;

    if ($("#alert").length <= 0)
    {
      $("body").append($("<div id='alert' class='alert alert-success'></div>"));
    }

    $("#alert")
        .html("<i class='fa fa-info-circle'></i>  &nbsp; " + message)
        .removeClass($("#alert").attr("class"))
        .addClass('alert ' + style)
        .animate({'top':-10})
        .delay(time)
        .animate({'top':-110});
};

// 成功提示
var success_message = function(message, time)
{
    prompt(message, 'alert-success', time);
};

// 失败提示
var fail_message = function(message, time)
{
    prompt(message, 'alert-danger', time);
};

// 提醒
var warning_message = function(message, time)
{
    prompt(message, 'alert-warning', time);
};

// 信息提示
var info_message = function(message, time)
{
    prompt(message, 'alert-info', time);
};
