const path = require('path');
const UglifyJSPlugin = require('uglifyjs-webpack-plugin')
const ExtractTextPlugin = require('extract-text-webpack-plugin')
const ManifestPlugin = require('webpack-manifest-plugin')
const CleanWebpackPlugin = require('clean-webpack-plugin')

const dev = process.env.NODE_ENV == 'development'

let cssLoaders = [
    { loader: 'css-loader', options: {importLoaders: 1, minimize: !dev }}
]

if (!dev) {
    cssLoaders.push({
        loader: 'postcss-loader',
        options: {
            plugins: (loader) => [
                require('autoprefixer')({
                    browsers: ['last 2 versions', 'ie > 8']
                })
            ]
        }
    })
}

let config = {
    entry: {
        widget: [path.resolve(__dirname, './sass/widget.scss'), path.resolve(__dirname, './js/widget.js')],
    },
    output: {
        // options related to how webpack emits results

        path: path.resolve(__dirname + '/../../public/', "b070b438-781d-11e7-b5a5-be2e44b06b34"), // string
        // the target directory for all output files
        // must be an absolute path (use the Node.js path module)

        filename: dev ? "js/[name].js" : "js/[name].[chunkhash:8].js", // string
        // the filename template for entry chunks

        publicPath: "/widgets/b070b438-781d-11e7-b5a5-be2e44b06b34/js/",
    },

    devtool: dev ? "cheap-module-eval-source-map" : false,

    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /(node_modules|bower_compoenents)/,
                use: ['babel-loader'],
            },
            {
                test: /\.css$/,
                use: ExtractTextPlugin.extract({
                    fallback: "style-loader",
                    use: cssLoaders,
                    publicPath: '../'
                })
            },
            {
                test: /\.scss$/,
                use: ExtractTextPlugin.extract({
                    fallback: "style-loader",
                    use: [...cssLoaders, 'sass-loader'],
                    publicPath: '../'
                })
            },
            {
                test: /\.(png|jpe?g|gif)$/,
                use: [
                    {
                        loader: 'url-loader',
                        options: {
                            limit: 100,
                            name: 'img/[name].[hash:8].[ext]',
                        }
                    }
                ]
            },
            {
                test: /\.vue$/,
                loader: 'vue-loader',
                options: {
                    loaders: {
                        js: 'babel-loader'
                    }
                }
            }
        ]
    },
    plugins: [
        new ExtractTextPlugin({
            filename: dev ? './css/[name].css' : './css/[name].[contenthash:8].css',
        }),
        new CleanWebpackPlugin(['b070b438-781d-11e7-b5a5-be2e44b06b34'], {
            root: path.resolve(__dirname + '/../../public/'),
            verbose: true,
            dry: false,
        })
    ]
}

if (!dev) {
    config.plugins.push(new UglifyJSPlugin({
        sourceMap: false
    }))
    config.plugins.push(new ManifestPlugin())
}

module.exports = config