        <form method="POST" action="">
            <table class="form-table">
                <tr>
                    <th>
                        <label for="upload_image">
                            Logotipo superior
                        </label>
                        <div id="preview_logo_top_upload"></div>
                    </th>
                    <td>
                        <input id="src_logo_top_upload" type="text" size="36" name="top_logo"  value="<?php echo $logo_top;?>"> 
                        <input id="logo_top_upload" class="button upload_image_theme" type="button" value="Upload Image" >
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="upload_image">
                            Logotipo inferior
                        </label>
                        <div id="preview-logo_footer_upload"></div>
                    </th>
                    <td>
                        <input id="src_logo_footer_upload" type="text" size="36" name="footer_logo"  value="<?php echo $logo_bottom;?>" > 
                        <input id="logo_footer_upload" class="button upload_image_theme" type="button" value="Upload Image" >
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="num_elements">
                            Cuenta de twitter
                        </label> 
                    </th>
                    <td>
                        <input type="text" name="twitter_acc" size="25" value="<?php echo $twitter;?>">
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="num_elements">
                            Cuenta de facebook
                        </label> 
                    </th>
                    <td>
                        <input type="text" name="facebook_acc" size="25"  value="<?php echo $facebook;?>">
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="num_elements">
                            Cuenta de Youtube
                        </label> 
                    </th>
                    <td>
                        <input type="text" name="youtube_acc" size="25"  value="<?php echo $youtube;?>">
                    </td>
                </tr>


            </table>
            <p>
    <input type="submit" value="Guardar cambios" class="button-primary"/>
    <input type="hidden" name="update_settings" value="Y" />
</p>
        </form>