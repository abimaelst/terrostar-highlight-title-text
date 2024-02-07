<p>
    <label for="custom_title_highlight_text" style="font-weight: 500;">Highlight Text:</label>
    <input type="text" id="custom_title_highlight_text" name="custom_title_highlight_text" value="<?php echo esc_attr($highlighted_text); ?>" style="width:100%;">
</p>
<p>
    <label for="custom_title_highlight_style" style="font-weight: 500;">Highlight Style:</label>
    <select id="custom_title_highlight_style" name="custom_title_highlight_style" value=<?php $highlight_style; ?> style="width:85%;">
        <option value="background" <?php selected($highlight_style, 'background'); ?>>Background</option>
        <option value="square" <?php selected($highlight_style, 'square'); ?>>Square</option>
        <option value="circle" <?php selected($highlight_style, 'circle'); ?>>Circle</option>
        <option value="underline" <?php selected($highlight_style, 'underline'); ?>>Underline</option>
        <option value="border" <?php selected($highlight_style, 'border'); ?>>Border</option>
        <option value="arrow" <?php selected($highlight_style, 'arrow'); ?>>Arrow</option>
    </select>
</p>
<p>
    <label for="custom_title_highlight_bold" style="font-weight: 500;">Make text bold</label>
    <input type="checkbox" id="custom_title_highlight_bold" name="custom_title_highlight_bold" value="1" <?php checked($highlight_bold, 1); ?>>
</p>
<p>
    <label for="custom_title_highlight_color" style="font-weight: 500;">Highlight Color:</label>
    <input type="color" id="custom_title_highlight_color" name="custom_title_highlight_color" value="<?php echo esc_attr($highlight_text_bold); ?>">
</p>
<p class="highlight-style-disclaimer" style="color: #d05813; font-size: 0.8em;">
    Note: The "circle" and "square" styles are best suited for single words.
</p>