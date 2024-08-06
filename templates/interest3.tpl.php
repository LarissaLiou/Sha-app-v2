<?php
    // session_start();
    $string_version = implode(',', $_SESSION);
    echo $string_version . "<br>";
    echo $_SESSION["email"] . "<br>";
    echo $_SESSION["password"] . "<br>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Just Arrived</title>
    <link rel="stylesheet" href="static/css/interest3.css">
</head>
<body>

        <nav>
            <h3 class="nav-logo" id="nav-logo">
                Solciate
            </h3>
        </nav>
        <section class="">
                <div class="bg-div">
                    <h2 class="">
                        Pick Your Interests
                    </h2>
                </div>
                    <!-- <div class="w-full p-8 mb-16 bg-gray-200 rounded-3xl"> -->
                        <div id="interestSelection" class="interestSelection">
                            <?php 
                                $fetchInterests = [
                                    'Art_and_Culture' => [
                                        'Digital_Art' => ['name' => 'Digital Art', 'selected' => false, 'interest_type' => 'Art_and_Culture'],
                                        'Drawing' => ['name' => 'Drawing', 'selected' => false, 'interest_type' => 'Art_and_Culture'],
                                        'Music' => ['name' => 'Music', 'selected' => false, 'interest_type' => 'Art_and_Culture'],
                                    ],
                                    'Career_and_Business' => [
                                        'Real_Estate' => ['name' => 'Real Estate', 'selected' => false, 'interest_type' => 'Career_and_Business'],
                                        'Startup' => ['name' => 'Startup', 'selected' => false, 'interest_type' => 'Career_and_Business'],
                                        'Marketing' => ['name' => 'Marketing', 'selected' => false, 'interest_type' => 'Career_and_Business'],
                                    ],
                                    'Technology' => [
                                        'Artificial Intelligent' => ['name' => 'Artificial Intelligent', 'selected' => false, 'interest_type' => 'Community_and_Event'],
                                        'Open Source' => ['name' => 'Open Source', 'selected' => false, 'interest_type' => 'Community_and_Event'],
                                        'Software Development' => ['name' => 'Software Development', 'selected' => false, 'interest_type' => 'Community_and_Event'],
                                    ],
                                    'Sports_and_Fitness' => [
                                        'Basketball' => ['name' => 'Basketball', 'selected' => false, 'interest_type' => 'Sciend_and_Education'],
                                        'Weightlifting' => ['name' => 'Weightlifting', 'selected' => false, 'interest_type' => 'Sciend_and_Education'],
                                        'Yoga' => ['name' => 'Yoga', 'selected' => false, 'interest_type' => 'Sciend_and_Education'],
                                    ],
                                    'Food_and_Culinary_Arts' => [
                                        'Cooking' => ['name' => 'Cooking', 'selected' => false, 'interest_type' => 'Health_and_Wellbeing'],
                                        'Coffee' => ['name' => 'Coffee', 'selected' => false, 'interest_type' => 'Health_and_Wellbeing'],
                                        'Food Blogging' => ['name' => 'Food Blogging', 'selected' => false, 'interest_type' => 'Health_and_Wellbeing'],
                                    ],
                                ];
                            ?>
                            <?php foreach ($fetchInterests as $category => $interests) : ?>
                                <h3 class="">
                                    <?php echo str_replace('_', ' ', $category); ?>
                                </h3>
                                <div class="interests-div">
                                    <?php foreach ($interests as $key => $interest) : ?>
                                        <div class="interest-items">
                                            <span class="interest-name"><?php echo $interest['name']; ?></span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>
                            
                        </div>
                        
                        <div class="footer-div">
                            <div class="footer-div2">
                                <button class="submitBtn" id="submitBtn">
                                    Next
                                </button>
                            </div>
                        </div>
                    <!-- </div> -->
        </section>
        <footer>
            <!-- <div> -->
                <span>© All Rights Reserved Socialite</span>
            <!-- </div> -->
        </footer>
        
    <script src="static/js/interest3.js"></script>
    
</body>

</html>
