<?php

/*
 * Copyright (c) 2021 Heimrich & Hannot GmbH
 *
 * @license LGPL-3.0-or-later
 */

namespace HeimrichHannot\TwigTemplatesBootstrap4Bundle\EventListener\Contao;

use Contao\CoreBundle\ServiceAnnotation\Hook;

/**
 * Class LoadDataContainerListener.
 *
 * @Hook("loadDataContainer")
 */
class LoadDataContainerListener
{
    public function __invoke(string $table): void
    {
        if ('tl_layout' !== $table) {
            return;
        }

        if (!class_exists('HeimrichHannot\TwigTemplatesBundle\HeimrichHannotTwigTemplatesBundle')) {
            return;
        }

        $dca = &$GLOBALS['TL_DCA']['tl_layout'];

        $dca['subpalettes']['ttFramework_bs4'] = 'ttUseFrameworkCustomControls';

        $dca['fields']['ttUseFrameworkCustomControls'] = [
            'label' => &$GLOBALS['TL_LANG']['tl_layout']['ttUseFrameworkCustomControls'],
            'exclude' => true,
            'inputType' => 'checkbox',
            'eval' => ['tl_class' => 'w50'],
            'sql' => "char(1) NOT NULL default ''",
        ];
    }
}
