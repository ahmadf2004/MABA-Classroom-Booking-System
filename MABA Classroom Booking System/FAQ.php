<?php
    // Title for the FAQ page
    echo '<h1>Frequently Asked Questions</h1>';
    ?>

    <div class="faq-container">
        <?php
        // Array of frequently asked questions and their corresponding answers
        $faqs = array(
            array(
                'question' => 'How do I book a classroom?',
                'answer' => 'Answer: To book a classroom, log in to your account and click on the date you want to select on the calendar. Select the desired date and write your name and classroom that you want to choose.'
            ),
            array(
                'question' => 'How do I know if I have booked a classroom?',
                'answer' => 'Answer: After you finish booking, there will be a mark showing that you have booked on the calendar page.'
            ),
            // Add more FAQs as needed
        );

        // Loop through the FAQs array and display each question and answer
        foreach ($faqs as $faq) {
            echo '<div class="faq">';
            echo '<h3>' . $faq['question'] . '</h3>';
            echo '<p>' . $faq['answer'] . '</p>';
            echo '</div>';
        }
        ?>
    </div>