<?php 
session_start(); 

    include('../inc/functions.php');
    $postObj = new Story();
    
    if(!isset($_SESSION['userid']) and $_SESSION['email']==''){
        
        header('location: /login.php');
    }
    
    $Userrow = $postObj->getUserDetailsById($_SESSION['userid']); 
    $Storyrow = $postObj->GetUserStoryById($_SESSION['userid']);  
    
    
?><!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <!-- Meta Tags -->
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="/images/wah_fav.ico">
    
  <title>My Profile | <?=$Userrow['name']?></title>
  
    <meta name="copyright" content="WahStory">
    <meta name="language" content="en">
    <meta name="language" content="hi">
    <meta name="theme-color" content="#181818" /> 
    
  <link rel="stylesheet" href="/assets/css/plugins/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/css/plugins/lightgallery.min.css">
  <link rel="stylesheet" href="/assets/css/plugins/slick.css">
  <link rel="stylesheet" href="/assets/css/plugins/lightgallery.min.css">
  <link rel="stylesheet" href="/assets/css/plugins/animate.css"> 
  
  <link rel="stylesheet" href="/assets/css/style.css">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

 
 
 
 
<script>
document.addEventListener('DOMContentLoaded', function() {
    const maxSelections = {
        1: 1,  // First dropdown: max 1 selection
        2: 3,  // Second dropdown: max 3 selections
        3: 6,  // Third dropdown: max 6 selections
        4: 4   // Fourth dropdown: max 4 selections
    };

    function initializeMultiSelect(id) {
        const container = document.getElementById(`selectContainer${id}`);
        const selectWrapper = container.querySelector('.select-wrapper');
        const select = document.getElementById(`countrySelect${id}`);
        const hiddenInput = container.querySelector(`input[name="country${id}"]`);
        const maxMessage = document.getElementById(`maxMessage${id}`);
        let selectedCountries = [];

        // Create custom dropdown
        const customDropdown = document.createElement('div');
        customDropdown.className = 'custom-dropdown';
        
        // Create dropdown button
        const dropdownButton = document.createElement('button');
        dropdownButton.type = 'button';
        dropdownButton.className = 'dropdown-button cs-form_field';
        dropdownButton.textContent = 'Select Country';
        
        // Create dropdown content
        const dropdownContent = document.createElement('div');
        dropdownContent.className = 'dropdown-content';
        
        // Create search input
        const searchInput = document.createElement('input');
        searchInput.type = 'text';
        searchInput.className = 'dropdown-search';
        searchInput.placeholder = 'Search countries...';
        
        // Create options container
        const optionsContainer = document.createElement('div');
        optionsContainer.className = 'options-container';

        // Build dropdown structure
        dropdownContent.appendChild(searchInput);
        dropdownContent.appendChild(optionsContainer);
        customDropdown.appendChild(dropdownButton);
        customDropdown.appendChild(dropdownContent);

        // Replace select with custom dropdown
        select.style.display = 'none';
        selectWrapper.appendChild(customDropdown);

        // Store all options
        const allOptions = Array.from(select.options)
            .slice(1)
            .map(option => option.value);

        // Initialize with existing values
        if (typeof userCountries !== 'undefined' && userCountries[`country${id}`]) {
            const initialValues = userCountries[`country${id}`].split(',');
            initialValues.forEach(value => {
                if (value) addTag(value);
            });
        }

        // Toggle dropdown
        dropdownButton.addEventListener('click', function(e) {
            e.stopPropagation();
            const isOpen = dropdownContent.classList.contains('show');
            closeAllDropdowns();
            if (!isOpen) {
                dropdownContent.classList.add('show');
                searchInput.focus();
                populateOptions('');
            }
        });

        // Handle search
        searchInput.addEventListener('input', function(e) {
            e.stopPropagation();
            populateOptions(this.value);
        });

        // Handle option selection
        optionsContainer.addEventListener('click', function(e) {
            if (e.target.classList.contains('dropdown-option')) {
                const selectedValue = e.target.dataset.value;
                if (selectedValue && !selectedCountries.includes(selectedValue)) {
                    addTag(selectedValue);
                }
                searchInput.value = '';
                populateOptions('');
            }
        });

        function populateOptions(searchTerm) {
            optionsContainer.innerHTML = '';
            allOptions
                .filter(country => 
                    country.toLowerCase().includes(searchTerm.toLowerCase()) &&
                    !selectedCountries.includes(country)
                )
                .forEach(country => {
                    const option = document.createElement('div');
                    option.className = 'dropdown-option';
                    option.textContent = country;
                    option.dataset.value = country;
                    optionsContainer.appendChild(option);
                });
        }

        function addTag(country) {
            if (selectedCountries.length >= maxSelections[id]) {
                maxMessage.style.display = 'block';
                return;
            }

            selectedCountries.push(country);
            updateTags();
            updateHiddenInput();
            
            if (selectedCountries.length >= maxSelections[id]) {
                maxMessage.style.display = 'block';
                dropdownButton.disabled = true;
            }
            closeAllDropdowns();
        }

        function removeTag(country) {
            selectedCountries = selectedCountries.filter(c => c !== country);
            updateTags();
            updateHiddenInput();
            maxMessage.style.display = 'none';
            dropdownButton.disabled = false;
        }

        function updateTags() {
            const existingTags = selectWrapper.querySelectorAll('.tag');
            existingTags.forEach(tag => tag.remove());

            selectedCountries.forEach(country => {
                const tag = document.createElement('span');
                tag.className = 'tag';
                tag.innerHTML = `
                    ${country}
                    <span class="tag-close" onclick="this.parentElement.dispatchEvent(new CustomEvent('removeTag', { detail: '${country}' }))">×</span>
                `;
                tag.addEventListener('removeTag', (e) => removeTag(e.detail));
                selectWrapper.insertBefore(tag, customDropdown);
            });
        }

        function updateHiddenInput() {
            hiddenInput.value = selectedCountries.join(',');
        }

        selectWrapper.addEventListener('removeTag', (e) => removeTag(e.detail));
    }

    // Close dropdowns when clicking outside
    function closeAllDropdowns() {
        document.querySelectorAll('.dropdown-content').forEach(content => {
            content.classList.remove('show');
        });
    }
    document.addEventListener('click', closeAllDropdowns);

    // Initialize all multi-select fields
    ['1', '2', '3', '4'].forEach(id => initializeMultiSelect(id));
});

// Add this if you have existing values
const userCountries = {
    country1: '<?= isset($Userrow['country1']) ? $Userrow['country1'] : '' ?>',
    country2: '<?= isset($Userrow['country2']) ? $Userrow['country2'] : '' ?>',
    country3: '<?= isset($Userrow['country3']) ? $Userrow['country3'] : '' ?>',
    country4: '<?= isset($Userrow['country4']) ? $Userrow['country4'] : '' ?>'
};
</script>



 <style>
     .single-post-content p b{
         color: #d1d1d1;
     } 
     form#updateprofile label{
         font-size: 12px;
         margin-bottom: 5px;
     }
     form#updateprofile .cs-form_field{
         padding: 8px 20px;
     }
     
     
     
     
     
  .select-container {
    position: relative;
    margin-bottom: 20px;
}

.select-heading {
    font-weight: 600;
    margin-bottom: 5px;
    color: #e91f3d;
}

.select-wrapper {
    position: relative;
    border: 1px solid #ddd;
    border-radius: 15px;
    min-height: 42px;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    padding: 5px 10px;
    gap: 5px;
}

.tag {
    background: #e91f3d;
    color: white;
    padding: 2px 8px;
    border-radius: 15px;
    display: inline-flex;
    align-items: center;
    margin: 2px;
    font-size: 14px;
    white-space: nowrap;
}

.tag-close {
    margin-left: 5px;
    cursor: pointer;
    font-weight: bold;
}

.tag-close:hover {
    opacity: 0.8;
}

select.cs-form_field {
    border: none;
    flex: 1;
    min-width: 100px;
    padding: 5px;
    background: transparent;
    margin-left: 5px;
}

select.cs-form_field:focus {
    outline: none;
}

.max-selection-message {
    display: none;
    color: #e91f3d;
    font-size: 12px;
    margin-top: 5px;
}

/* Custom dropdown arrow */
select.cs-form_field {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 1em;
    padding-right: 30px;
}

/* For Firefox */
select.cs-form_field:-moz-focusring {
    color: transparent;
    text-shadow: 0 0 0 #000;
}

/* For IE/Edge */
select.cs-form_field::-ms-expand {
    display: none;
}






.custom-dropdown {
    position: relative;
    width: 100%;
}

.dropdown-button {
    width: 100%;
    text-align: left;
    cursor: pointer;
    background: transparent;
    border: none;
    padding: 8px 20px;
}

.dropdown-button:disabled {
    background-color:#181818;;
    cursor: not-allowed;
}

.dropdown-content {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    z-index: 1000;
    max-height: 300px;
    overflow-y: auto;
}

.dropdown-content.show {
    display: block;
}

.dropdown-search {
    width: 100%;
    padding: 8px;
    border: none;
    border-bottom: 1px solid #ddd;
    position: sticky;
    top: 0;
    background:#181818;
}

.dropdown-search:focus {
    outline: none;
    border-bottom-color: #e91f3d;
}

.options-container {
    max-height: 250px;
    overflow-y: auto;
    background:#181818;
}

.dropdown-option {
    padding: 8px 12px;
    cursor: pointer;
}

.dropdown-option:hover {
    background-color:#e91f3d;
}

/* Maintain existing tag styles */
.tag {
    background: #e91f3d;
    color: white;
    padding: 2px 8px;
    border-radius: 15px;
    display: inline-flex;
    align-items: center;
    margin: 2px;
    font-size: 14px;
    white-space: nowrap;
}

.tag-close {
    margin-left: 5px;
    cursor: pointer;
    font-weight: bold;
}

.tag-close:hover {
    opacity: 0.8;
}

/* Scrollbar styles */
.options-container::-webkit-scrollbar {
    width: 6px;
}

.options-container::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.options-container::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 3px;
}

.options-container::-webkit-scrollbar-thumb:hover {
    background: #555;
}
 </style>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
 <?php include('../header.php');?>
 <!-- Start Hero -->
   
  
   <!-- End Hero -->
  <div class="cs-height_50 cs-height_lg_50"></div>
  <div class="cs-height_100 cs-height_lg_100"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
          
        <div class="dashboard-left-menu">
            <div class="cs-shop_sidebar">
                <div class="cursor-pointer openleftmenu">
                   <i class="fa-solid fa-bars"></i>
                </div>
              <div class="cs-shop_sidebar_widget">
                <?php $Dmenu = 3;?>
                <?php include('user.leftmenu.php');?>
              </div>
            </div>
        </div>
        
        
      </div>
      <div class="col-lg-9 single-profile">
          <div class="cs-height_0 cs-height_lg_40"></div>
          
          <div class="row"> 
            <div class="col-sm-12"> 
              <h4 class="mb-2">Update Skills & Tools</h4>
              <hr class="mb-4">
            </div>
         <form id="updateprofile" action="#" method="POST"> 
        
        <div class="row"> 
          
  <div class="select-container" id="selectContainer1">
    <h4 class="select-heading">Update Industry (Select up to 1)</h4>
    <div class="select-wrapper">
        <select class="cs-form_field" id="countrySelect1">
            <option value="">Select Industry</option>
            <?php 
                $CountrySql = $postObj->getAllCountries();
                foreach($CountrySql as $CountryRow){
            ?>
                <option value="<?=$CountryRow['country'];?>"><?=$CountryRow['country'];?></option>
            <?php } ?>
        </select>
    </div>
    <input type="hidden" name="country1" />
    <div class="max-selection-message" id="maxMessage1">Maximum 1 industry selected</div>
</div>

<!-- Second Select -->
<div class="select-container" id="selectContainer2">
    <h4 class="select-heading">Update Skills (Select up to 3)</h4>
    <div class="select-wrapper">
        <select class="cs-form_field" id="countrySelect2">
            <option value="">Select Skills</option>
            <?php 
                $CountrySql = $postObj->getAllCountries();
                foreach($CountrySql as $CountryRow){
            ?>
                <option value="<?=$CountryRow['country'];?>"><?=$CountryRow['country'];?></option>
            <?php } ?>
        </select>
    </div>
    <input type="hidden" name="country2" />
    <div class="max-selection-message" id="maxMessage2">Maximum 3 Skills selected</div>
</div>

<!-- Third Select -->
<div class="select-container" id="selectContainer3">
    <h4 class="select-heading">Update Tools (Select up to 6)</h4>
    <div class="select-wrapper">
        <select class="cs-form_field" id="countrySelect3">
            <option value="">Select Tools</option>
            <?php 
                $CountrySql = $postObj->getAllCountries();
                foreach($CountrySql as $CountryRow){
            ?>
                <option value="<?=$CountryRow['country'];?>"><?=$CountryRow['country'];?></option>
            <?php } ?>
        </select>
    </div>
    <input type="hidden" name="country3" />
    <div class="max-selection-message" id="maxMessage3">Maximum 6 Tools selected</div>
</div>

<!-- Fourth Select -->
<div class="select-container" id="selectContainer4">
    <h4 class="select-heading">Update Traits (Select up to 4)</h4>
    <div class="select-wrapper">
        <select class="cs-form_field" id="countrySelect4">
            <option value="">Select Traits</option>
            <?php 
                $CountrySql = $postObj->getAllCountries();
                foreach($CountrySql as $CountryRow){
            ?>
                <option value="<?=$CountryRow['country'];?>"><?=$CountryRow['country'];?></option>
            <?php } ?>
        </select>
    </div>
    <input type="hidden" name="country4" />
    <div class="max-selection-message" id="maxMessage4">Maximum 4 Traits selected</div>
</div>
        </div>
        
          <div class="col-lg-12">  
          
            <div class="cs-height_10 cs-height_lg_10"></div>
            <button class="cs-btn cs-style1" type="submit" name="updateprofile">
              <span>Update Now</span>
                              
            </button>
            <div id="cs-result"></div>
          </div>
        </form> 
        
          </div> <!-- Row Ends-->
          
          
        </div>
         
      </div>
    </div>
  </div>
  <div class="cs-height_50 cs-height_lg_80"></div>
  
   
   <!-- Start CTA -->
    <?php include('../footer.section.php');?>
    <?php include('footer.commonJS.php');?> 
     
    
    <script>
        $(document).ready(function () {
            // Open Left Menu Of User Dashboard
            const openMenuBtn = document.querySelector('.openleftmenu');
            const openMenuBtnicon = document.querySelector('.openleftmenu i');
            const sidebar = document.querySelector('.dashboard-left-menu');
             
            openMenuBtn.addEventListener('click', function () {
                sidebar.classList.toggle('open'); 
                openMenuBtnicon.classList.toggle('fa-times'); 
            });
        });
    </script>
        
        </body>
    </html>