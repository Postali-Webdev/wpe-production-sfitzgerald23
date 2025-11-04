<?php
/**
 * Template Name: DTI Calculator Page
 */
get_header(); ?>

<main class="main-content">

    <?php
    $page_thumbnail = get_the_post_thumbnail_url();

    if ($page_thumbnail) :?>

        <section class="page-hero" <?php bg($page_thumbnail); ?>>
            <div class="page-hero__overlay">
                <div class="grid-container">
                    <div class="grid-x grid-margin-x ">
                        <div class="cell medium-10">
                            <h1 class="page-title entry__title"><?php the_title(); ?></h1>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    <?php else: ?>
        <section class="page-hero-no-bg">
            <div class="grid-container">
                <div class="grid-x grid-margin-x ">
                    <div class="cell"><h1 class="page-title page-title-no-bg entry__title"><?php the_title(); ?></h1></div>
                </div>
            </div>

        </section>

    <?php endif; ?>


    <div class="grid-container">
        <div class="grid-x ">
            <div class="cell medium-8">
                <?php
                if (function_exists('yoast_breadcrumb')) {
                    yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
                }
                ?>
            </div>
        </div>
        <div class="grid-x ">
            <!-- BEGIN of page content -->
            <div class="cell medium-12">
                <?php if (have_rows('table_of_contents')): ?>
                    <div class="table-of-contents">
                        <?php if ($table_of_contents_title = get_field('table_of_contents_title')) : ?>
                            <h3 class="table-of-contents__title"><?php echo $table_of_contents_title; ?> <i
                                    class="fa-sharp fa-solid fa-angle-down"></i></h3>
                        <?php endif; ?>
                        <ol class="table-of-contents__list">
                            <?php while (have_rows('table_of_contents')) : the_row();

                                // Load sub field value.
                                $title = get_sub_field('title');
                                $anchor_link = get_sub_field('anchor_link');
                                ?>
                                <li class="table-of-contents__item"><a
                                        href="#<?php echo $anchor_link; ?>"><?php echo $title; ?></a></li>
                            <?php endwhile; ?>
                        </ol>

                    </div>
                <?php endif; ?>


                <section class="full-width-text">
                    <div class="grid-container">
                        <div class="grid-x">
                            <div class="cell medium-12">
                                <?php the_field("top_content"); ?>
                            </div>
                        </div>
                    </div>
                </section>



                <article <?php post_class('entry'); ?>>
                    <div class="entry__content">
                        <?php the_content('', true); ?>

                            <div class="dti-calculator">
                            <div class="calculator-header">
                                <h2>Debt-to-Income Ratio Calculator</h2>
                                <p>Find out if bankruptcy could be the right solution for you</p>
                            </div>

                            <div class="input-group">
                                <label for="monthly-debts">Total Monthly Debt Payments</label>
                                <div class="input-wrapper">
                                    <span>$</span>
                                    <input type="number" id="monthly-debts" placeholder="0" min="0" max="99999" step="1">
                                </div>
                            </div>

                            <div class="input-group">
                                <label for="gross-income">Gross Monthly Income</label>
                                <div class="input-wrapper">
                                    <span>$</span>
                                    <input type="number" id="gross-income" placeholder="0" min="0" max="99999" step="1">
                                </div>
                            </div>

                            <div class="result-section" id="result-section" style="display: none;">
                                <div class="result-label">Your Debt-to-Income Ratio</div>
                                <div class="result-value" id="dti-result">0%</div>
                                <div class="result-status" id="dti-status">Calculating...</div>
                            </div>

                            <div class="info-section">
                                <h3>Understanding Your DTI Ratio</h3>
                                <ul>
                                    <li><strong>Under 36%:</strong> Excellent - Healthy financial position</li>
                                    <li><strong>36-43%:</strong> Good - Manageable debt level. Review our website or contact us for a free consultation to explore your bankruptcy options</li>
                                    <li><strong>43-50%:</strong> High - Immediate action recommended. Contact us today for a free consultation to discuss debt relief solutions</li>
                                    <li><strong>Over 50%:</strong> Critical - Urgent assistance needed. Call us immediately for emergency debt relief consultation</li>
                                </ul>
                            </div>

                            <div class="cta-section" id="cta-section" style="display: none;">
                                <h3 id="cta-heading">Need Financial Guidance?</h3>
                                <p id="cta-message">If your DTI ratio is above 50%, it may be time to explore your options.</p>
                                <button class="cta-button" onclick="scheduleConsultation()" title="Free and Confidential Consultation">Schedule Free Consultation</button>

                                <div class="phone-numbers" id="phone-display" style="display: none;">
                                    <h4>Call us directly:</h4>
                                    <div id="phone-content">
                                        <!-- Phone numbers will be dynamically inserted here -->
                                    </div>
                                </div>
                            </div>

                            <p style="text-align: center; color: #888; font-size: 12px; margin-top: 20px;">
                                Your information is secure and confidential. We do not store or share your financial data.
                            </p>
                        </div>

                        <?php if ($final_cta = get_field('final_cta')) { ?>
                            <div class="final-cta">
                                <a href="<?php echo esc_url($final_cta['url']) ?>"
                                   target="<?php echo esc_attr($final_cta['target']) ?: '_self'; ?>" class="button">
                                    <?php echo esc_html($final_cta['title']); ?>
                                </a>
                            </div>
                        <?php } ?>
                        <?php if (have_rows('content_accordion')): ?>
                            <div class="content-accordion">
                                <ul class="accordion" data-accordion data-allow-all-closed="true">
                                    <?php while (have_rows('content_accordion')): the_row();
                                        $heading = get_sub_field('heading');
                                        $content = get_sub_field('content');
                                        if ($heading && $content):?>
                                            <li class="accordion-item"
                                                data-accordion-item>
                                                <a href="#" class="accordion-title">
                                                    <h2>
                                                        <?php echo esc_html($heading); ?>
                                                    </h2>
                                                </a>
                                                <div class="accordion-content" data-tab-content>
                                                    <?php echo $content; ?>
                                                </div>
                                            </li>
                                        <?php
                                        endif;
                                    endwhile; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </article>


                <section class="full-width-text">
                    <div class="grid-container">
                        <div class="grid-x ">
                            <div class="cell medium-12">
                                <?php the_field("bottom_content"); ?>
                            </div>
                        </div>
                    </div>
                </section>


            </div>
            <!-- END of page content -->
        </div>
    </div>
</main>

<script>
// Global variables
const monthlyDebtsInput = document.getElementById('monthly-debts');
const grossIncomeInput = document.getElementById('gross-income');
const resultSection = document.getElementById('result-section');
const dtiResult = document.getElementById('dti-result');
const dtiStatus = document.getElementById('dti-status');
const ctaSection = document.getElementById('cta-section');
const ctaHeading = document.getElementById('cta-heading');
const ctaMessage = document.getElementById('cta-message');
const ctaButton = document.querySelector('.cta-button');
const phoneDisplay = document.getElementById('phone-display');
const phoneContent = document.getElementById('phone-content');

// Configuration
const CALENDLY_URL = 'https://calendly.com/d/2nn-3ny-hfz'; // CONFIRM THIS URL WITH CLIENT

// Phone numbers by region
const PHONE_NUMBERS = {
    shreveport: { number: '(318) 868-2600', areas: ['Shreveport', 'Monroe'] },
    alexandria: { number: '(318) 625-7505', areas: ['Alexandria'] },
    lafayette: { number: '(337) 984-1584', areas: ['Lafayette', 'Lake Charles'] }
};

// Main calculation function
function calculateDTI() {
    const monthlyDebts = parseFloat(monthlyDebtsInput.value) || 0;
    const grossIncome = parseFloat(grossIncomeInput.value) || 0;

    if (grossIncome > 0) {
        const dtiRatio = (monthlyDebts / grossIncome) * 100;
        displayResult(dtiRatio);

        // Track calculation in Google Analytics
        if (typeof gtag !== 'undefined') {
            gtag('event', 'dti_calculator_used', {
                'event_category': 'calculator',
                'event_label': 'dti_ratio',
                'value': Math.round(dtiRatio)
            });
        }
    } else {
        resultSection.style.display = 'none';
        ctaSection.style.display = 'none';
    }
}

// Display results with dynamic messaging
function displayResult(ratio) {
    resultSection.style.display = 'block';
    dtiResult.textContent = ratio.toFixed(1) + '%';

    // Remove all status classes
    dtiStatus.className = 'result-status';

    // Reset button styles
    ctaButton.style.background = '';
    ctaButton.style.animation = '';

    if (ratio < 36) {
        // Excellent - No CTA
        dtiStatus.textContent = 'Excellent';
        dtiStatus.classList.add('status-excellent');
        ctaSection.style.display = 'none';
    } else if (ratio < 43) {
        // Good - Soft CTA
        dtiStatus.textContent = 'Good';
        dtiStatus.classList.add('status-good');
        ctaSection.style.display = 'block';
        ctaHeading.textContent = 'Explore Your Options';
        ctaMessage.textContent = 'Your debt is manageable, but bankruptcy could still provide relief. Learn about your options with a free, no-obligation consultation.';
        ctaButton.textContent = 'Schedule Free Consultation';
        ctaButton.style.background = '#2196F3';
        phoneDisplay.style.display = 'none';
    } else if (ratio < 50) {
        // High - Urgent CTA
        dtiStatus.textContent = 'High';
        dtiStatus.classList.add('status-high');
        ctaSection.style.display = 'block';
        ctaHeading.textContent = 'Take Action Now';
        ctaMessage.textContent = 'Your debt level requires immediate attention. Don\'t wait - get professional help to explore debt relief solutions today.';
        ctaButton.textContent = 'Get Help Now - Free Consultation';
        ctaButton.style.background = '#ff6b35';
        phoneDisplay.style.display = 'block';
        displayPhoneNumbers();
    } else {
        // Critical - Emergency CTA
        dtiStatus.textContent = 'Critical';
        dtiStatus.classList.add('status-critical');
        ctaSection.style.display = 'block';
        ctaHeading.textContent = 'Urgent: You Need Help Today';
        ctaMessage.textContent = 'Your financial situation is critical. Contact us immediately for emergency debt relief assistance. We can help stop the cycle.';
        ctaButton.textContent = 'Call Now for Emergency Help';
        ctaButton.style.background = '#d32f2f';
        ctaButton.style.animation = 'pulse 2s infinite';
        phoneDisplay.style.display = 'block';
        displayPhoneNumbers();
    }

    // Track which DTI range for analytics
    if (typeof gtag !== 'undefined') {
        let range = 'under-36';
        if (ratio >= 36 && ratio < 43) range = '36-43';
        else if (ratio >= 43 && ratio < 50) range = '43-50';
        else if (ratio >= 50) range = '50-plus';

        gtag('event', 'dti_calculator_result', {
            'event_category': 'calculator',
            'event_label': range,
            'value': Math.round(ratio)
        });
    }
}

// Display phone numbers
function displayPhoneNumbers() {
    // Option 1: Display all phone numbers
    phoneContent.innerHTML = `
        <p><strong>Shreveport / Monroe:</strong> <a href="tel:3188682600">(318) 868-2600</a></p>
        <p><strong>Alexandria:</strong> <a href="tel:3186257505">(318) 625-7505</a></p>
        <p><strong>Lafayette / Lake Charles:</strong> <a href="tel:3379841584">(337) 984-1584</a></p>
    `;

    // Option 2: Display based on user location (requires geolocation or IP detection)
    // Uncomment below and implement location detection if preferred
    /*
    getUserLocation().then(location => {
        const phoneInfo = getPhoneByLocation(location);
        phoneContent.innerHTML = `
            <p>Call us at: <a href="tel:${phoneInfo.number.replace(/[^0-9]/g, '')}">${phoneInfo.number}</a></p>
            <p style="font-size: 12px;">Serving ${phoneInfo.areas.join(', ')}</p>
        `;
    });
    */
}

// Schedule consultation function
function scheduleConsultation() {
    const dtiRatio = parseFloat(dtiResult.textContent);

    // Track CTA click
    if (typeof gtag !== 'undefined') {
        let range = 'unknown';
        if (dtiRatio >= 36 && dtiRatio < 43) range = '36-43';
        else if (dtiRatio >= 43 && dtiRatio < 50) range = '43-50';
        else if (dtiRatio >= 50) range = '50-plus';

        gtag('event', 'dti_calculator_cta_click', {
            'event_category': 'calculator',
            'event_label': 'consultation_request',
            'event_value': Math.round(dtiRatio),
            'dti_range': range
        });
    }

    // Option A: Calendly Integration (Recommended)
    if (typeof Calendly !== 'undefined') {
        Calendly.initPopupWidget({
            url: CALENDLY_URL,
            prefill: {
                customAnswers: {
                    a1: `DTI Ratio: ${dtiRatio}%`
                }
            }
        });
    } else {
        // Fallback: Direct redirect to Calendly
        window.open(CALENDLY_URL, '_blank');
    }

    // Option B: Contact Form Modal
    // Uncomment if you have a modal system
    /*
    if (typeof openContactModal === 'function') {
        openContactModal({
            source: 'DTI Calculator',
            dtiRatio: dtiRatio
        });
    }
    */

    // Option C: Direct Page Redirect
    // Uncomment to use
    /*
    window.location.href = `/schedule-consultation?source=dti-calculator&ratio=${dtiRatio}`;
    */

    // Option D: For critical cases (50%+), could trigger immediate phone call
    /*
    if (dtiRatio >= 50) {
        if (confirm('Your situation requires immediate attention. Would you like us to call you right now?')) {
            window.location.href = 'tel:3188682600';
        }
    }
    */
}

// Event listeners
monthlyDebtsInput.addEventListener('input', calculateDTI);
grossIncomeInput.addEventListener('input', calculateDTI);

// Format numbers with commas
function formatNumberInput(input) {
    let value = input.value.replace(/,/g, '');
    if (!isNaN(value) && value !== '') {
        input.value = parseFloat(value).toLocaleString('en-US', {
            maximumFractionDigits: 0
        });
    }
}

// Add number formatting on blur


// Prevent negative numbers
[monthlyDebtsInput, grossIncomeInput].forEach(input => {
    input.addEventListener('keydown', (e) => {
        if (e.key === '-' || e.key === 'e') {
            e.preventDefault();
        }
    });
});

// Initialize Calendly if script is loaded
if (!document.querySelector('script[src*="calendly.com"]')) {
    const calendlyScript = document.createElement('script');
    calendlyScript.src = 'https://assets.calendly.com/assets/external/widget.js';
    calendlyScript.async = true;
    document.head.appendChild(calendlyScript);
}

// Add Calendly CSS
if (!document.querySelector('link[href*="calendly.com"]')) {
    const calendlyCSS = document.createElement('link');
    calendlyCSS.href = 'https://assets.calendly.com/assets/external/widget.css';
    calendlyCSS.rel = 'stylesheet';
    document.head.appendChild(calendlyCSS);
}
</script>

<style>
        .dti-calculator {
            max-width: 500px;
            margin: 0 0 0 40px;
            padding: 30px;
            background: #f8f9fa;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .calculator-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .calculator-header h2 {
            color: #333;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .calculator-header p {
            color: #666;
            font-size: 16px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 600;
            font-size: 14px;
            width: 50%;
        }

        .input-wrapper {
            position: relative;
            width: 50%;
        }

        .input-wrapper span {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
            font-size: 16px;
        }

        .input-group input {
            width: 100%;
            padding: 12px 12px 12px 35px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
            box-sizing: border-box;
        }

        .input-group input:focus {
            outline: none;
            border-color: #4CAF50;
        }

        .result-section {
            margin-top: 30px;
            padding: 20px;
            background: white;
            border-radius: 8px;
            text-align: center;
        }

        .result-label {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }

        .result-value {
            font-size: 48px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .result-status {
            font-size: 18px;
            font-weight: 600;
            padding: 8px 20px;
            border-radius: 20px;
            display: inline-block;
        }

        .status-excellent {
            background: #e8f5e9;
            color: #2e7d32;
        }

        .status-good {
            background: #fff3e0;
            color: #f57c00;
        }

        .status-high {
            background: #ffebee;
            color: #c62828;
        }

        .status-critical {
            background: #d32f2f;
            color: white;
        }

        .info-section {
            margin-top: 30px;
            padding: 20px;
            background: #e3f2fd;
            border-radius: 8px;
            border-left: 4px solid #1976d2;
        }

        .info-section h3 {
            color: #1976d2;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .info-section ul {
            margin: 0;
            padding-left: 20px;
        }

        .info-section li {
            color: #555;
            margin-bottom: 8px;
            line-height: 1.6;
        }

        .cta-section {
            margin-top: 30px;
            text-align: center;
            padding: 25px;
            background: #fff;
            border-radius: 8px;
            border: 2px dashed #ddd;
        }

        .cta-section h3 {
            color: #333;
            margin-bottom: 15px;
        }

        .cta-section p {
            color: #666;
            margin-bottom: 20px;
        }

        .cta-button {
            background: #2196F3;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
            position: relative;
        }

        .cta-button:hover {
            background: #1976d2;
        }

        /* Tooltip for legal compliance */
        .cta-button:hover::after {
            content: "Free & Confidential Consultation";
            position: absolute;
            bottom: -30px;
            left: 50%;
            transform: translateX(-50%);
            background: #333;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            white-space: nowrap;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(211, 47, 47, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(211, 47, 47, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(211, 47, 47, 0);
            }
        }

        .phone-numbers {
            margin-top: 20px;
            padding: 15px;
            background: #f5f5f5;
            border-radius: 8px;
            font-size: 14px;
        }

        .phone-numbers h4 {
            margin-bottom: 10px;
            color: #333;
        }

        .phone-numbers a {
            color: #2196F3;
            text-decoration: none;
            font-weight: 600;
        }

        @media (max-width: 600px) {
            .dti-calculator {
                padding: 20px;
            }

            .result-value {
                font-size: 36px;
            }
        }
    </style>


<?php get_footer(); ?>
