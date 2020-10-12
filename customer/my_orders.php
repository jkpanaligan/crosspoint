<center><!--  center Begin  -->

    <h1> My Orders </h1>

    <p class="lead"> Your orders on one place</p>

    <p class="text-muted">

        If you have any questions, feel free to <a href="../contact.php">Contact Us</a>. Our Customer Service work <strong>24/7</strong>

    </p>

</center><!--  center Finish  -->


<hr>


<div class="table-responsive"><!--  table-responsive Begin  -->

    <table class="table table-bordered table-hover"><!--  table table-bordered table-hover Begin  -->

        <thead><!--  thead Begin  -->

            <tr><!--  tr Begin  -->

                <th> No: </th>
                <th> Order Date:</th>
                <th> Transaction No.: </th>
                <th> Sub Total: </th>
                <th> Tax: </th>
                <th> Grand Total: </th>

            </tr><!--  tr Finish  -->

        </thead><!--  thead Finish  -->

        <tbody><!--  tbody Begin  -->

           <?php

            $customer_session = $_SESSION['email'];

            $get_customer = "SELECT * from customers where email='$customer_session'";

            $run_customer = mysqli_query($db,$get_customer);

            $row_customer = mysqli_fetch_array($run_customer);

            $customer_id = $row_customer['id'];

            $get_orders = "SELECT * from transactions where customer_id='$customer_id'";

            $run_orders = mysqli_query($db,$get_orders);

            $i = 0;

            while($row_orders = mysqli_fetch_array($run_orders)){

                $txn_date = substr($row_orders['txn_date'],0,11);

                $id = $row_orders['id'];

                $sub_total = $row_orders['sub_total'];

                $tax = $row_orders['tax'];

                $grand_total = $row_orders['grand_total'];

                $i++;

            ?>

            <tr><!--  tr Begin  -->

                <th> <?php echo $i; ?> </th>
                <td> <?php echo $txn_date; ?> </td>
                <td> <?php echo $id; ?> </td>
                <td> $<?php echo $sub_total; ?> </td>
                <td> <?php echo $tax; ?> </td>
                <td> <?php echo $grand_total; ?> </td>

            </tr><!--  tr Finish  -->

            <?php } ?>

        </tbody><!--  tbody Finish  -->

    </table><!--  table table-bordered table-hover Finish  -->

</div><!--  table-responsive Finish  -->
