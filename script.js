const $$ = mdui.JQ;

function creat_gif() {
    const type = location.hash.substring(1);
    const small = $$("#" + type + "-small-size").is(":checked");
    const get_input_data = $$("input[name='" + type + "_value']").get();
    const input_data = [];

    for (let i = 0; i < get_input_data.length; i++) {
        if (get_input_data[i].value === '' || get_input_data[i].value === false) {
            input_data[i] = get_input_data[i].placeholder;
        } else {
            input_data[i] = get_input_data[i].value;
        }
    }

    $$("button[onclick='creat_gif()']").attr("disabled", "");//添加禁止操作属性
    $$("button[onclick='creat_gif()']").html("正在生成中，请稍等一会儿...");

    $$.ajax({
        method: 'POST',
        url: 'api.php',
        data: {
            type: type,
            data: input_data,
            small: small,
        },
        dataType: 'json',
        success: function (data) {
            let result;
            if (data.code === 200) {
                if (data.upload_status === 'success') {
                    result = '<h4>生成成功！</h4><p>点击预览：<a class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-cyan" href="' + data.path + '" target="_blank">预览</a></p>';
                } else {
                    result = '<h4>生成成功！</h4><p>点击预览：<a class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-cyan" href="' + data.path + '" target="_blank">预览</a></p>';
                }
            } else {
                result = '<h4>生成失败！</h4><p>error code：' + data.code + '</p><br/><p>error msg：' + data.msg + '</p>';
            }
            mdui.alert(result);
            $$("button[onclick='creat_gif()']").removeAttr("disabled", "");//添加禁止操作属性
            $$("button[onclick='creat_gif()']").html("生成");
        }
    });
}
