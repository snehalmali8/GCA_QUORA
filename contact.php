<?php include "header.php"; ?>
    <title>Contact Us</title>
<!--<div class="body_contact">-->
    <?php
    $showAlert = false;
    $method = $_SERVER["REQUEST_METHOD"];
    if ($method == "POST") {
        // echo "hii";
        $email = $_POST['email'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $msj = $_POST['message'];
        $sql = "INSERT INTO `contact` (`email`, `name`, `mobile`, `message`) VALUES ('$email', '$name', '$phone', '$msj')";
        $result = mysqli_query($conn, $sql);
        $showAlert = true;
    }
    ?>
    <?php
    if ($showAlert) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your message has been send successfully!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>';
    // echo $phone;
    }
    ?>
    <div class="body_contact wrapper1">
    <h4 class=" heading_contact text-center my-4">Fill the Details to Contact Us</h4>

    <div class="container my-2 contact">
        <form class="contact-form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
            <!-- <h4 class=" heading text-center my-4">Fill the Details to Contact Us</h4> -->
            <div class="mb-3">
                <label for="name" class="form-label"><b>Full Name:</b></label>
                <input name="name" type="text" class="form-control" id="name" placeholder=" Your full name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label"><b>Email Id:</b></label>
                <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp"
                    placeholder="Your email address" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label"><b>Phone No:</b></label>
                <input name="phone" type="phone" class="form-control" id="phone" placeholder="Your mobile no." required>
            </div>

            <div class="mb-3">
                <label for="message" class="form-label"><b>Message</b></label>
                <textarea name="message" type="text" class="form-control" id="message" row="4"
                    placeholder="Write your message..."></textarea>
            </div>
            <button type="submit" class="btn contact-button contact-anchor text-center button">Send Message</button>
            <button type="reset" class="btn reset-button reset-anchor button"> Reset</button>
        </form>
    </div>
    </div>
    <!--</div>-->
    <?php include "footer.php"; ?>



<!-- Government College of Engineering & Research
Avasari - Khurd,
Taluka - Ambegaon,
District - Pune, 412405
Tel : 02133- 230582
Fax : 02133-230583
Email: office.gcoeavasari@dtemaharashtra.gov.in
Website: gcoeara.ac.in 
Developed & Managed by   Government College of Engineering & Research Avasari ,Pune.
 Web-Information-Manager (Website Content Managed by Computer Engineering Department)
 Copyright © GCOEAR, Avasari Khurd