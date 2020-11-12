<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="product-data-field" method="POST" enctype="multipart/form-data" novalidate>
    <div style="display: flex; flex-wrap: wrap">
        <div style="padding-right: 25px">
            <div style="display: flex">
                <div  style="margin-bottom: 6px; margin-left: 2px; color: rgb(19, 184, 55); width: 300px"><?php echo $product_created ?></div>
            </div>
            <div style="display: flex">
                <div  style="margin-bottom: 6px; margin-left: 2px; color: rgb(218, 47, 47); width: 300px"><?php echo $err ?></div>
            </div>
            
            <!--  label_for - labe_content - error - type - name - id - input value  >>>> Product name <<<<-->
            <?php generateInputText(
                "product_name", // label for
                "Product Name", // label text
                $error["product_nameErr"], // error associated
                "text", // input type
                "product_name", // label for
                "product_name", // label for
                $submitted_product_name //
            ); ?>
            <!-- SKU -->
            <?php generateInputText("product_sku", "SKU", $error["skuErr"], "text", "product_sku", "product_sku", $submitted_sku); ?>

            <!--  label_for - labe_content - error - type - name - id - input value  >>>> Description <<<<-->
            <?php generateTextArea("product_desc", "Description", $error["product_descErr"],"product_desc", "product_desc", $submitted_desc) ?>

            <!--  label_for - labe_content - error - type - name - id - input value  >>>> Suppliers <<<<-->
            <div style="display: flex">
                <label style="font-weight: bold; margin-left: 3px;" for="suppliers">Supplier</label>
                <div class="invalid-credential"><?php echo $error["product_supplierErr"]; ?></div>
                <a target="_blank" href="https://localhost/E-COMMERCE/Admin/entities/supplier-management/add-supplier.php" class="link-label-button" id="add-sup-link">add supplier</a>
            </div>
            <?php
                include "../design-entities/common-functions.php";
                $common = new CommonFunctionProvider();
                $common->getSuppliersAsDropdownlist($submitted_supplier);
            ?>
            
            <!--  label_for - labe_content - error - type - name - id - input value  >>>> Category <<<<-->
            <div style="display: flex">
                <label style="font-weight: bold; margin-left: 3px;" for="category">Category</label>
                <div class="invalid-credential"><?php echo $error["product_categoryErr"]; ?></div>
                <a target="_blank" href="https://localhost/E-COMMERCE/Admin/entities/category-management/add-category.php" class="link-label-button" id="add-sup-link">add category</a>
            </div>
            <?php
                $common = new CommonFunctionProvider();
                $common->getCategoriesAsDropDownList('form-dropDown', $submitted_category);
            ?>

            <!--  label_for - labe_content - error - type - name - id - input value  >>>> Unit price <<<<-->
            <?php generateDecimalInput("product_unit_price", "Unit price", $error["product_unit_priceErr"],"product_unit_price", "product_unit_price", $submitted_unit_price, ".01") ?>
        </div>
        
        <div style="padding-top: 12px; padding-right: 12px">
            <p style="width: 250px; margin-top: 0; font-size: 14px">Available sizes and colors should be separated by colones</p>
            <!--  label_for - labe_content - error - type - name - id - input value  >>>> Available sizes <<<< -->
            <?php generateInputText("product_av_sizes", "Available sizes", $error["product_av_sizesErr"], "text","product_av_sizes", "product_av_sizes", $submitted_available_sizes) ?>

            <!--  label_for - labe_content - error - type - name - id - input value  >>>> Available colors <<<< -->
            <?php generateInputText("product_av_colors", "Available colors", $error["product_av_colorsErr"], "text","product_av_colors", "product_av_colors", $submitted_available_colors) ?>

            <!--  label_for - labe_content - error - type - name - id - input value  >>>> Unit size <<<< -->
            <?php generateInputText("product_size", "Size", $error["product_sizeErr"], "text","product_size", "product_size", $submitted_size) ?>

            <!--  label_for - labe_content - error - type - name - id - input value  >>>> Unit color <<<< -->
            <?php generateInputText("product_color", "Color", $error["product_colorErr"], "text","product_color", "product_color", $submitted_color) ?>

            <!--  label_for - labe_content - error - type - name - id - input value  >>>> Unit discount <<<< -->
            <?php generateDecimalInput("product_discount", "Discount", $error["product_discountErr"], "product_discount", "product_discount", $submitted_discount, ".01") ?>

            <!--  label_for - labe_content - error - type - name - id - input value  >>>> Unit weight <<<< -->
            <?php generateDecimalInput("product_unit_weight", "Unit weight", $error["product_unit_weightErr"], "product_unit_weight", "product_unit_weight", $submitted_unit_weight, ".01") ?>
        </div>
        <div>
            <!--  label_for - labe_content - error - type - name - id - input value  >>>> Unit weight <<<< -->
            <?php generateDecimalInput("product_units_in_stock", "Units in stock", $error["product_units_in_stockErr"], "product_units_in_stock", "product_units_in_stock", $submitted_units_in_stock, "") ?>

            <!--  label_for - labe_content - error - type - name - id - input value  >>>> Unit weight <<<< -->
            <?php generateDecimalInput("product_units_on_order", "Units on order", $error["product_units_on_orderErr"], "product_units_on_order", "product_units_on_order", $submitted_units_on_order, "") ?>

            <!--  label_for - labe_content - error - type - name - id - input value  >>>> Unit weight <<<< -->
            <?php generateDecimalInput("product_available", "Products available", $error["product_availabilityErr"], "product_available", "product_available", $submitted_product_available, "") ?>

            <!--  label_for - labe_content - error - type - name - id - input value  >>>> Unit color <<<< -->
            <?php generateTextArea("product_keywords", "Keywords", $error["product_keywordsErr"], "product_keywords","product_keywords", $submitted_keywords) ?>

            <?php
                generateFileInput("product_picture", "Picture", $error["product_pictureErr"], "product_picture", "product_picture");
            ?>
        </div>
    </div>
</form>