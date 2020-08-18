<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $count = 1;
        $setting = $this->findSetting('site.title');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.site.title'),
                'value'        => 'Enrutador GIS v1.0',
                'details'      => '',
                'type'         => 'text',
                'order'        => $count++,
                'group'        => 'Site',
            ])->save();
        }

        $setting = $this->findSetting('site.description');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.site.description'),
                'value'        => __('voyager::seeders.settings.site.description'),
                'details'      => '',
                'type'         => 'text',
                'order'        => $count++,
                'group'        => 'Site',
            ])->save();
        }

        $setting = $this->findSetting('site.logo');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.site.logo'),
                'value'        => '',
                'details'      => '',
                'type'         => 'image',
                'order'        => $count++,
                'group'        => 'Site',
            ])->save();
        }

        $setting = $this->findSetting('site.google_analytics_tracking_id');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.site.google_analytics_tracking_id'),
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => $count++,
                'group'        => 'Site',
            ])->save();
        }

        $setting = $this->findSetting('site.page');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => 'Pagina',
                'value'        => 'landingpage',
                'details'      => '',
                'type'         => 'text',
                'order'        => $count++,
                'group'        => 'Site',
            ])->save();
        }

        $count = 1;
        $setting = $this->findSetting('admin.bg_image');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.admin.background_image'),
                'value'        => '',
                'details'      => '',
                'type'         => 'image',
                'order'        => $count++,
                'group'        => 'Admin',
            ])->save();
        }

        $setting = $this->findSetting('admin.title');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.admin.title'),
                'value'        => 'Enrutador',
                'details'      => '',
                'type'         => 'text',
                'order'        => $count++,
                'group'        => 'Admin',
            ])->save();
        }

        $setting = $this->findSetting('admin.description');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.admin.description'),
                'value'        => __('voyager::seeders.settings.admin.description_value'),
                'details'      => '',
                'type'         => 'text',
                'order'        => $count++,
                'group'        => 'Admin',
            ])->save();
        }

        $setting = $this->findSetting('admin.loader');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.admin.loader'),
                'value'        => '',
                'details'      => '',
                'type'         => 'image',
                'order'        => $count++,
                'group'        => 'Admin',
            ])->save();
        }

        $setting = $this->findSetting('admin.icon_image');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.admin.icon_image'),
                'value'        => '',
                'details'      => '',
                'type'         => 'image',
                'order'        => $count++,
                'group'        => 'Admin',
            ])->save();
        }

        $setting = $this->findSetting('admin.google_analytics_client_id');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => __('voyager::seeders.settings.admin.google_analytics_client_id'),
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => $count++,
                'group'        => 'Admin',
            ])->save();
        }


         // ---------------------Whatsapp ------------------------------------
        // ------------------------------------------------------------
        $count=1;
        $setting = $this->findSetting('whatsapp.phone');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => 'Numero de Móvil',
                'value'        => '59171130523',
                'details'      => '',
                'type'         => 'text',
                'order'        => $count++,
                'group'        => 'Whatsapp',
            ])->save();
        }
        $setting = $this->findSetting('whatsapp.popupMessage');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => 'Titulo',
                'value'        => 'Hola, Necesitas Ayuda?',
                'details'      => '',
                'type'         => 'text',
                'order'        => $count++,
                'group'        => 'Whatsapp',
            ])->save();
        }
        $setting = $this->findSetting('whatsapp.message');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => 'Mensaje de Bienvenida',
                'value'        => 'Quiero mas Info..',
                'details'      => '',
                'type'         => 'text_area',
                'order'        => $count++,
                'group'        => 'Whatsapp',
            ])->save();
        }
        $setting = $this->findSetting('whatsapp.headerTitle');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => 'Titulo Header',
                'value'        => 'Mi Chat',
                'details'      => '',
                'type'         => 'text',
                'order'        => $count++,
                'group'        => 'Whatsapp',
            ])->save();
        }
        $setting = $this->findSetting('whatsapp.color');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => 'Color',
                'value'        => '#5991FB',
                'details'      => '',
                'type'         => 'text',
                'order'        => $count++,
                'group'        => 'Whatsapp',
            ])->save();
        }
        $setting = $this->findSetting('whatsapp.buttonImage');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => 'Imagen del boton',
                'value'        => '',
                'details'      => '',
                'type'         => 'image',
                'order'        => $count++,
                'group'        => 'Whatsapp',
            ])->save();
        }
        $setting = $this->findSetting('whatsapp.position');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => 'Posicion del boton',
                'value'        => '',
                'details'      => '',
                'type'         => 'text',
                'order'        => $count++,
                'group'        => 'Whatsapp',
            ])->save();
        }
        $setting = $this->findSetting('whatsapp.autoOpenTimeout');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => 'Tiempo de espera para abrir',
                'value'        => '50000',
                'details'      => '',
                'type'         => 'text',
                'order'        => $count++,
                'group'        => 'Whatsapp',
            ])->save();
        }
        $setting = $this->findSetting('whatsapp.size');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => 'Tamanio del boton',
                'value'        => '72px',
                'details'      => '',
                'type'         => 'text',
                'order'        => $count++,
                'group'        => 'Whatsapp',
            ])->save();
        }


        // ---------------------RRSS ------------------------------------
        // ------------------------------------------------------------
        $count=1;
        $setting = $this->findSetting('rrss.facebook');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => 'Facebbok',
                'value'        => null,
                'details'      => null,
                'type'         => 'text',
                'order'        => $count++,
                'group'        => 'RRSS',
            ])->save();
        }
        $setting = $this->findSetting('rrss.instagram');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => 'Instagram',
                'value'        => null,
                'details'      => null,
                'type'         => 'text',
                'order'        => $count++,
                'group'        => 'RRSS',
            ])->save();
        }
        $setting = $this->findSetting('rrss.twitter');
        if (!$setting->exists) {
            $setting->fill([
                'display_name' => 'Twitter',
                'value'        => null,
                'details'      => null,
                'type'         => 'text',
                'order'        => $count++,
                'group'        => 'RRSS',
            ])->save();
        }
        

    }

    /**
     * [setting description].
     *
     * @param [type] $key [description]
     *
     * @return [type] [description]
     */
    protected function findSetting($key)
    {
        return Setting::firstOrNew(['key' => $key]);
    }
}
