const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin')

module.exports = {
    entry: './index.js',
    module: {
        rules: [
            {
                test: /\.scss$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    {
                        loader: 'css-loader'
                    },
                    {
                        loader: 'sass-loader',
                        options: {
                            sourceMap: true
                        }
                    }
                ]
            },
        ]
    },
    output: {
        path: path.resolve(__dirname),
        filename: 'javascript/index.js'
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: 'css/index.css'
        }),
    ]
};