<?php
//# Script 8.4 - WidgetShoppingCart.php
echo 'hi';
/* This page defines the WidgetShoppingCart class.
* The class contains one attribute: an array called $items.
* The class contains five methods: 
* - is_empty()
* - add_item()
* - update_item()
* - delete_item()
* - display_cart()
*/

class WidgetShoppingCart {

// Attribute:
protected  $items = array();


// Method that returns a Boolean
// value indicating if the cart is empty:
public function is_empty() {
if (empty($this->items)) {
return true;
} else {
return false;
}
}

//echo $_SERVER;
// Method for adding an item to a cart.
// Takes two arguments: the item ID and an array of info.
public function add_item($id, $info) {

// Is it already in the cart?
if (isset($this->items[$id])) {

// Call the update_item() method: /(script continues on next page)
$this->update_item($id, $this->items[$id]['qty'] + 1);

} else {

// Add the array of info:
$this->items[$id] = $info;

// Add the quantity.
$this->items[$id]['qty'] = 1;

// Print a message:
echo "<p>The widget '{$info['name']}' in color {$info['color']}, size {$info['size']}
has been added to your shopping cart.</p>\n";

}

} // End of add_item() method.


// Method for updating an item in the cart.
// Takes two arguments: the item ID and the quantity.
public function update_item($id, $qty) {

// Delete if $qty equals 0:
if ($qty == 0) {

$this->delete_item($id);

} elseif ( ($qty > 0) && ($qty != $this->items[$id]['qty'])) {

// Update the quantity:
$this->items[$id]['qty'] = $qty;

// Print a message:
echo "<p>You now have $qty copy(ies) of the widget '{$this->items[$id]['name']}' in
color {$this->items[$id]['color']}, size {$this->items[$id]['size']} in your shopping
cart.</p>\n";

}

} // End of update_item() method.


// Method for deleting an item in the cart.
// Takes one argument: the item ID.
public function delete_item($id) {

// Confirm that it's in the cart:
if (isset($this->items[$id])) {

//(script continues on next page)
// Print a message:
echo "<p>The widget '{$this->items[$id]['name']}' in color {$this->items[$id]['color']}, size {$this->items[$id]['size']} has been removed from your shopping
cart.</p>\n";

// Remove the item:
unset($this->items[$id]);

}

} // End of delete_item() method.


// Method for displaying the cart.
// Takes one argument: a form action value.
public function display_cart($action = false) {

// Print a table:
echo '<table border="0" width="90%" cellspacing="2" cellpadding="2" align="center">
<tr>
<td align="left" width="20%"><b>Widget</b></td>
<td align="left" width="15%"><b>Size</b></td>
<td align="left" width="15%"><b>Color</b></td>
<td align="right" width="15%"><b>Price</b></td>
<td align="center" width="10%"><b>Qty</b></td>
<td align="right" width="15%"><b>Total Price</b></td>
</tr>
';

// Print form code, if appropriate.
if ($action) {
echo '<form action="' . $action . '" method="post">
<input type="hidden" name="do" value="update" />
';
}

// Initialize the total:
$total = 0;

// Loop through each item:
foreach ($this->items as $id => $info) {

// Calculate the total and subtotals:
$subtotal = $info['qty'] * $info['price']; 
$total += $subtotal;
$subtotal = number_format($subtotal, 2); 

// Determine how to show the quantity:
$qty = ($action) ? "<input type=\"text\" size=\"3\" name=\"qty[$id]\" value=\"{$info['qty']}\" />" :  $info['qty'];
//(script continues on next page)
//Script 8.4 continued
//331
//Real-World OOP
//Creating a Shopping Cart Class
//132
//133 // Print the row:

echo <<<EOT
<tr>
<td align="left">{$info['name']}</td>
<td align="left">{$info['size']}</td>
<td align="left">{$info['color']}</td>
<td align="right">\${$info['price']}</td>
<td align="center">$qty</td>
<td align="right">\$$subtotal</td>
</tr>\n
EOT;

} // End of FOREACH loop.

// Complete the table:
echo ' <tr>
<td colspan="5" align="right"><b>Total:<b></td>
<td align="right">$' . number_format ($total, 2) . '</td>
</tr>';
//152
// Complete the form, if appropriate:
if ($action) {
echo '<tr>
<td colspan="6" align="center">Set an item\'s quantity to 0 to remove it from your
cart.</td>
</tr>
<tr>
<td colspan="6" align="center"><button type="submit" name="submit" value="update">Update
Cart</button></td>
</tr>
</form>';
}

echo '</table>';


//165
} // End of display_cart() method.

} // End of WidgetShoppingCart class.
//169
echo 'bye';

?>