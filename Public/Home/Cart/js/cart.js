$(function(){
	$('.add_btn').click(function(){
        var goods_id=$('#add_btn').attr('data');
        var num=$('[name=amount]').val();
        var attr=getAttr();
        var data={'goods_id':goods_id,'num':num,'attr':attr};
        $.ajax({
            'url':'/Home/Cart/addCart',
            'type':'post',
            'data':data,
            'dataType':'json',
            'success':function(msg){
                if(msg==2){
                    alert('添加购物车失败');
                }else{
                    var pos=getElementPos('add_btn');
                    $('#cartBox').css({'left':pos.x-80,'top':pos.y-120});
                    $('#goods_number').text(msg['number']);
                    $('#goods_totalprice').text(msg['price']);
                    $('#cartBox').show();
                }
            }
        })
	})
    $('.delcart').click(function(){
        var cart_id=$(this).attr('data');
        var td=$(this);
        $.post('/Home/Cart/delCart',{'cart_id':cart_id},function(msg){
            if(msg){
                td.parent().parent().remove();
            }else{
                alert('删除失败');
            }
        })
    })
    
})
function getAttr(){
    var result='';
    $('.product').each(function(){
        result+=$(this).find('dt').html()+' :';
        result+=$(this).find('input:checked').val()+",";
    })
    return result;
}



function getElementPos(elementId) {
    var ua = navigator.userAgent.toLowerCase();
    var isOpera = (ua.indexOf('opera') != -1);
    var isIE = (ua.indexOf('msie') != -1 && !isOpera); // not opera spoof
    var el = document.getElementById(elementId);
    if(el.parentNode === null || el.style.display == 'none') {
        return false;
    }
    var parent = null;
    var pos = [];
    var box;
    if(el.getBoundingClientRect) {   //IE
        box = el.getBoundingClientRect();
        var scrollTop = Math.max(document.documentElement.scrollTop, document.body.scrollTop);
        var scrollLeft = Math.max(document.documentElement.scrollLeft, document.body.scrollLeft);
        return {
            x:box.left + scrollLeft, 
            y:box.top + scrollTop
        };
    }else if(document.getBoxObjectFor) {   // gecko
        box = document.getBoxObjectFor(el);
        var borderLeft = (el.style.borderLeftWidth)?parseInt(el.style.borderLeftWidth):0;
        var borderTop = (el.style.borderTopWidth)?parseInt(el.style.borderTopWidth):0;
        pos = [box.x - borderLeft, box.y - borderTop];
    }else {   // safari & opera
        pos = [el.offsetLeft, el.offsetTop];
        parent = el.offsetParent;
        if (parent != el) {
            while (parent) {
                pos[0] += parent.offsetLeft;
                pos[1] += parent.offsetTop;
                parent = parent.offsetParent;
            }
        }
        if (ua.indexOf('opera') != -1 || ( ua.indexOf('safari') != -1 && el.style.position == 'absolute' )) {
            pos[0] -= document.body.offsetLeft;
            pos[1] -= document.body.offsetTop;
        }
    }
    if (el.parentNode) {
        parent = el.parentNode;
    } else {
        parent = null;
    }
    while (parent && parent.tagName != 'BODY' && parent.tagName != 'HTML') { // account for any scrolled ancestors
        pos[0] -= parent.scrollLeft;
        pos[1] -= parent.scrollTop;
        if (parent.parentNode) {
            parent = parent.parentNode;
        } else {
            parent = null;
        }
    }
    return {
        x:pos[0], 
        y:pos[1]
    };
}

/**
 * 关闭页面的元素标签
 * @param elm 被关闭标签的id
 */
function hideElement(elm){
    $('#'+elm).hide();
}

