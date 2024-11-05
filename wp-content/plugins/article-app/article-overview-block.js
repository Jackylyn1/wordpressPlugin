wp.blocks.registerBlockType('custom/article-overview', {
    title: 'Article Overview',
    icon: 'shortcode',
    category: 'widgets',

    edit: () => {
            return wp.element.createElement(wp.blockEditor.InnerBlocks, {
                allowedBlocks: ['core/shortcode'],
                template: [['core/shortcode', { text: '[article_app]' }]]
            });
        },
    save: () => null,
});