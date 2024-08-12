<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Knee Pain Services</title>
    <link rel="stylesheet" type="text/css" href="services.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arsenal:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'header.php'; 
    ?>
    <div>
        <div class="Services-Banner">
            <div class="service-section1">
                <img src="Images/kneepain1.webp">
            </div>
            <div class="service-section2">
                <h1>Knee Pain</h1><br>
                <p>
                    Knee joint is the biggest joint in our body and works as a connection between the hip and the foot. It helps in transmitting the load of the body from the hip and core to our feet and thus allows us to stand , move and balance. It comprises various ligaments which provide stability to the joint and meniscus which provides cushioning to the joint. Knee pain is a common medical complaint that can affect people of all age groups. The prevalence can vary based on factors like age , lifestyle , gender and underlying health conditions.
                </p>
            </div>
        </div>

        <div class="Services-Middle">
            <h1>Causes</h1><br>

            <div class="Services-Middle-Container">
                <div class="Services-Middle-Details">
                    <div class="Services-Middle-Paragraph">
                        <h3>Knee Injuries</h3>
                        <p>Ligament injuries : Common ligament injuries of the knee are ACL, PCL, MCL, LCL injury that causes pain and instability depending on the severity of the injury. A complete tear of any of these causes severe instability in the knee.</p>
                        <p>Meniscal injuries: Meniscus provides cushioning to the knee joint. Injury or tear to the meniscus causes pain, swelling and locking of the knee.</p>
                        <p>Tendon injuries : The commonest tendon injury of the knee joint is Patellar tendinitis. Also known as Jumper’s knee, characterized by the inflammation of the patellar tendon, caused by repetitive stress or overuse of the knee.</p>
                    </div>
                    <div class="Services-Middle-Paragraph">
                        <h3>Arthritis</h3>
                        <p>Osteoarthritis: Degeneration of the knee joint or the wear and tear of the cartilage in the knee joint causes pain, stiffness and reduction in range of motion.</p>
                        <p>Rheumatoid arthritis: It is an autoimmune condition that leads to inflammation and damage to the synovium lining of the knee joint leading to excruciating pain and swelling.</p>
                        <p>Gout arthritis: This is a form of inflammatory arthritis that affects multiple joints, usually starts with pain and swelling in the big toe.</p>
                    </div>
                    <div class="Services-Middle-Paragraph">
                        <h3>Bursitis</h3>
                        <p>Inflammation of the bursa sacs located around the knee joint can cause pain and swelling. Prepatellar bursitis (housemaid's knee) and anserine bursitis are examples.</p>
                    </div>
                    <div class="Services-Middle-Paragraph">
                        <h3>Overuse and Strain</h3>
                        <p>Strain is the injury to the muscles around the knee joint, caused due to overuse or poor mechanics of the knee joint.</p>
                    </div>
                    <div class="Services-Middle-Paragraph">
                        <h3>Tumors</h3>
                        <p>Tumors or cancer in the bones also causes pain in the knee.</p>
                    </div>
                    <div class="Services-Middle-Paragraph">
                        <h3>Fracture</h3>
                        <p>A broken bone in or around the knee such as the patella, femur and tibia can be extremely painful.</p>
                    </div>
                </div>
                <div class="Services-Middle-Image">
                    <img src="Images/kneepain2.webp">
                </div>
            </div>
        </div>
        <div class="Services-Last">
            <h1>How to Manage</h1>
            <div class="Services-Last-Container">
                <div class="Services-Last-Images">
                    <div class="Services-position-relative">
                        <img src="Images/kneepain4.webp">
                        <div class="Services-position-absolute">
                            <img src="Images/kneepain5.webp">
                        </div>
                    </div>
                </div>

                <div class="Services-Last-Paragraph">
                    <p>Diagnosis and treatment of knee pain depend on its underlying cause. If you experience persistent or severe knee pain, it's essential to consult a healthcare professional for a thorough evaluation.Treatment options may include rest, physical therapy, medications, injections, braces, and in some cases, surgical interventions. Management strategies also focus on addressing the root cause and preventing further knee pain or injury.
                    </p>

                    <br>

                    <div class="Services-Last-Button">
                        <a href="userDashboard.php">Book a demo session now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php';?>
</body>
</html>