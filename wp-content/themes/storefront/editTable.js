jQuery(document).ready(function() {
    jQuery(".shop_table_responsive >thead>tr>.product-subtotal").after("<th>Product Text</th>");
    jQuery(".shop_table_responsive >tbody>tr>.product-subtotal").after("<td id='customField'></td>");

    jQuery("#customField").text(obj.text_product);



});