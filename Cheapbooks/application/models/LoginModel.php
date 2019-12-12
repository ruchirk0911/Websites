<?php
class LoginModel extends CI_Model {

    public function login()
    {
        $basketId = '';
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        $pass = md5($password);

        $query = $this->db->query("SELECT password FROM Customers WHERE username='$username'");


        foreach ($query->result() as $row)
        {
            $regpassword = $row->password;
            if($pass == $regpassword){
                $basket = $this->db->query("SELECT basketid FROM Shoppingbasket WHERE username='$username'");
                foreach ($basket->result() as $row1)
                {
                    $basketId = $row1->basketid;
                }
            }
        }
        
        return $basketId;
    }

    public function shoppingCount(){
        $id= filter_input(INPUT_POST, 'basketId', FILTER_SANITIZE_STRING);
        $query1 = $this->db->query("SELECT SUM(number) as total FROM Contains WHERE basketid='$id'");
        foreach ($query1->result() as $row1)
        {
            $total = $row1->total;
            if($total == null){
                return "0";
            }else{
                return $total;
            }
        }
    }

    public function Search(){
        $btn = filter_input(INPUT_POST, 'btn', FILTER_SANITIZE_NUMBER_INT);
        $text = filter_input(INPUT_POST, 'text', FILTER_SANITIZE_STRING);
        $data = "";
        if($btn == 1){
        $query2 = $this->db->query("SELECT A.ISBN, title, total FROM (SELECT isbn, title FROM book WHERE isbn IN (SELECT isbn FROM `writtenby` WHERE ssn IN (SELECT ssn FROM Author WHERE name LIKE '%".$text."%'))) AS A, (SELECT `ISBN`,SUM(number) AS `total` FROM `stocks` GROUP BY ISBN) AS B WHERE A.isbn  = B.isbn");
            $data .= "<center><h2>Seach By Author</h2></center>";
        }elseif($btn == 2) {
            $query2 = $this->db->query("SELECT A.isbn, title, total FROM (SELECT isbn, title FROM book WHERE title LIKE '%".$text."%') AS A, (SELECT `ISBN`,SUM(number) AS `total` FROM `stocks` GROUP BY ISBN) AS B WHERE A.isbn  = B.isbn");
            $data .= "<center><h2>Seach By Book Title</h2></center>";
        }
        if($query2->num_rows()> 0){
            $data .= "
                <table class='table table-striped'>
                <thead>
                <th>ISBN</th>
                <th> Book Title</th>
                <th>Number of Copies</th>
                <th  class='col-md-1'>Quantity</th>
                <th></th>
                </thead>
                <tbody>";
            foreach ($query2->result() as $row2){
                $isbn = $row2->isbn;
                $title = $row2->title;
                $total = $row2->total;
                if($total > 0){
                    $data .= "<tr>
                    <td>".$isbn."</td>
                    <td>".$title."</td>
                    <td>".$total."</td>
                    <td  class='col-md-1'><input type='text' id=".$isbn."></td>
                    <td><button class='btn btn-primary' aria-label='Left Align' onclick='addCart(".$isbn.",".$total.")'><center><span class='glyphicon glyphicon-shopping-cart' aria-hidden='true'></span> Add to Cart</center></button></td>
                    </tr>";
                }else{
                    $data .= "<tr>
                    <td>".$isbn."</td>
                    <td>".$title."</td>
                    <td>".$total."</td>
                    <td>Out of Stock!</td>
                    <td></td>
                    </tr>";
                }      
            }
            $data .= "</tbody></table>";
        }else{
            $data .= '<div class="row data"><center>
                <h3>No results found!</h3></center>
                </div>';
        }
        return $data;
    }

    public function addToCart(){
        $isbn = filter_input(INPUT_POST,"isbn",FILTER_SANITIZE_STRING);
        $qty = filter_input(INPUT_POST,"qty",FILTER_SANITIZE_NUMBER_INT);
        $id= $this->session->user_session['basketId'];
        $sql = $this->db->query("SELECT number FROM Contains WHERE ISBN='".$isbn."' AND basketid='$id'");
        if ($sql->num_rows() > 0) {
            $num = 0;
            foreach ($sql->result() as $row)
            {
                $num = $row->number;
                $sum = $num + $qty;
                $sql1 = $this->db->query("UPDATE Contains SET number=".$sum." WHERE ISBN='".$isbn."' AND basketid='$id'");
            }
        }else{
            $sql = $this->db->query("INSERT INTO Contains Values('$isbn','$id', '$qty')");
        }
        $sql1= $this->db->query("SELECT SUM(number) as total FROM Contains WHERE basketid='$id'");
        if ($sql1->num_rows() > 0) {
            foreach ($sql1->result() as $row1) {
                $total= $row1->total;       
            }   
        }
        return $total;
    }

    public function viewCart(){
        $id = $this->session->user_session['basketId'];
        $data = "";
        $sql= $this->db->query("SELECT book.title, contains.ISBN AS isbn, SUM(contains.number) AS addn, SUM(contains.number) * book.price AS price FROM contains LEFT JOIN book ON contains.ISBN = book.ISBN WHERE contains.basketId = '$id' GROUP BY contains.ISBN");
        $total = 0;
      if ($sql->num_rows()>0) {
      $data .= "
      <table class='table table-striped'>
      <thead>
          <th>Book Title</th>
          <th>ISBN</th>
          <th>Number of Books</th>
          <th>Price</th>
      </thead>
      <tbody>"; 
        foreach ($sql->result() as $row){
          $total += $row->price;
          $title = $row->title;
          $number = $row->addn;
          $isbn = $row->isbn;
          $cost = $row->price;
            $data .='<tr>
            <td>'.$title.'</td>
            <td>'.$isbn.'</td>
            <td>'.$number.'</td>
            <td>$'.number_format($cost, 2).'</td>
        </tr>';

        }
        $data .= "</tbody></table>
        <p><strong>Total Amount:</strong> $".number_format($total,2)."</p>
      <button class='btn  btn-success btn-block buy' onclick='window.location=`Buy`'>Buy</button>";
      }else{
        $data .= "<center><h2>Cart Empty!</h2></center>";
      }
      return $data;
    }

    public function register(){
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
        $email  = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
        $pass = md5(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
        $basketid= uniqid();
        $sql = $this->db->query("INSERT INTO Customers values('$username','$address','$email','$phone','$pass')");
        $sql1= $this->db->query("INSERT INTO Shoppingbasket values('$basketid','$username')");
        return true;
    }

    public function buy(){
        $basketId = $this->session->user_session['basketId'];
        $username = $this->session->user_session['username'];


        $user_order_query = "SELECT a.ISBN , SUM(a.number) as addn from contains a , book b where a.ISBN = b.ISBN and a.basketId = '$basketId' GROUP BY a.ISBN";
        $order_result = $this->db->query($user_order_query);
        foreach($order_result->result() as $book_contains){
            $book_purchased = $book_contains->addn;
            echo $stock_query = "SELECT * from stocks where ISBN ='$book_contains->ISBN'";
            $book_warehouse_result = $this->db->query($stock_query);
            foreach ($book_warehouse_result->result() as $book_warehouse){
                $warehouse_books = $book_warehouse->number;

                if (($book_purchased - $warehouse_books) >0 && $warehouse_books != 0){
                    $count = 0;
                    if($book_purchased > $warehouse_books) {
                        $count = $warehouse_books;
                        $balance = $book_purchased - $warehouse_books;
                    }else {
                        $count =  $book_purchased - $warehouse_books;
                        $balance = $count;
                    }
                    $ship =  "INSERT INTO shippingorder VALUES('$book_contains->ISBN', '$book_warehouse->warehousecode','$username', '$count' )";
                    $ship_exec = $this->db->query($ship);

                    $stock_update = "UPDATE stocks SET number='0' WHERE ISBN='$book_contains->ISBN' AND warehousecode='$book_warehouse->warehousecode'";
                    $update_stock_result = $this->db->query($stock_update);
                    $book_purchased = $balance;

                } elseif (($book_purchased - $warehouse_books) <=0) {
                    $balance =  $warehouse_books - $book_purchased;
                    $ship =  "INSERT INTO shippingorder VALUES('$book_contains->ISBN', '$book_warehouse->warehousecode','$username', '$book_purchased' )";
                    $ship_exec = $this->db->query($ship);

                    $stock_update = "UPDATE stocks SET number='$balance' WHERE ISBN='$book_contains->ISBN' AND warehousecode='$book_warehouse->warehousecode'";
                    $update_stock_result = $this->db->query($stock_update);
                    $book_purchased = $balance;
                    break;
                }
            }
        }
        $delete_contains = $this->db->query("DELETE FROM Contains Where BasketID='$basketId'");

        return 0;
    }
}

?>