<p>
    <label for="custom_title_highlight_text">Highlight Text:</label>
    <input type="text" id="custom_title_highlight_text" name="custom_title_highlight_text" value="<?php echo esc_attr($highlighted_text); ?>" style="width:100%;">
</p>
<p>
    <label for="custom_title_highlight_style">Highlight Style:</label>
    <select id="custom_title_highlight_style" name="custom_title_highlight_style">
        <option value="background" <?php selected($highlight_style, 'background'); ?>>Background</option>
        <option value="circle" <?php selected($highlight_style, 'circle'); ?>>Circle</option>
        <option value="underline" <?php selected($highlight_style, 'underline'); ?>>Underline</option>
    </select>
</p>
<p>
    <label for="custom_title_highlight_color">Highlight Color:</label>
    <input type="color" id="custom_title_highlight_color" name="custom_title_highlight_color" value="<?php echo esc_attr($highlight_color); ?>">
</p>