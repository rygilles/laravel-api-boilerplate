const path = require('path');
const UglifyJSPlugin = require('uglifyjs-webpack-plugin')
const ExtractTextPlugin = require('extract-text-webpack-plugin')
const ManifestPlugin = require('webpack-manifest-plugin')
const CleanWebpackPlugin = require('clean-webpack-plugin')
const StringReplacePlugin = require("string-replace-webpack-plugin")

const dev = process.env.NODE_ENV == 'development'


settings = require('./settings.json');

const widget_id = settings.build.widget_id;
const widget_public_root_path = settings.build.widget_public_root_path;

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

        path: path.resolve(__dirname + '/../../public/', widget_id), // string
        // the target directory for all output files
        // must be an absolute path (use the Node.js path module)

        filename: dev ? "js/[name].js" : "js/[name].[chunkhash:8].js", // string
        // the filename template for entry chunks

        publicPath: widget_public_root_path,
    },

    devtool: dev ? "cheap-module-eval-source-map" : false,

    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /(node_modules)/,
                use: ['babel-loader', StringReplacePlugin.replace({
                    replacements: [
                        {
                            pattern: /<!-- @widget_setting\((\w*?)\) -->/ig,
                            replacement: function (match, p1, offset, string) {
                                return settings.js[p1];
                            }
                        }
                    ]
                })],
            },
            {
                test: /\.css$/,
                use: ExtractTextPlugin.extract({
                    fallback: "style-loader",
                    use: cssLoaders,
                })
            },
            {
                test: /\.scss$/,
                use: ExtractTextPlugin.extract({
                    fallback: "style-loader",
                    use: [...cssLoaders, 'sass-loader'],
                })
            },
            {
                test: /\.(png|jpe?g|gif|svg)$/,
                use: [
                    {
                        loader: 'url-loader',
                        options: {
                            limit: 10000,
                            name: 'img/[name].[hash:8].[ext]',
                        }
                    }
                ]
            },
            {
                test: /\.(mp4|webm|ogg|mp3|wav|flac|aac)(\?.*)?$/,
                use : [
                    {
                        loader: 'url-loader',
                        options: {
                            limit: 10000,
                            name: 'media/[name].[hash:8].[ext]'
                        }
                    }
                ]
            },
            {
                test: /\.(woff2?|eot|ttf|otf)(\?.*)?$/,
                use : [
                    {
                        loader: 'url-loader',
                        options: {
                            limit: 10000,
                            name: 'fonts/[name].[hash:8].[ext]',
                        },
                    }
                ]
            },
            {
                test: /\.vue$/,
                use: [
                    {
                        loader: 'vue-loader',
                        options: {
                            loaders: {
                                js: 'babel-loader'
                            }
                        }
                    },
                    StringReplacePlugin.replace({
                        replacements: [
                            {
                                pattern: /<!-- @widget_setting\((\w*?)\) -->/ig,
                                replacement: function (match, p1, offset, string) {
                                    return settings.js[p1];
                                }
                            }
                        ]
                    })
                ]
            },
        ]
    },
    plugins: [
        new StringReplacePlugin(),
        new ExtractTextPlugin({
            filename: dev ? './css/[name].css' : './css/[name].[contenthash:8].css',
        }),
        new CleanWebpackPlugin([widget_id], {
            root: path.resolve(__dirname + '/../../public/'),
            verbose: true,
            dry: false,
        })
    ],
}

if (!dev) {
    config.plugins.push(new UglifyJSPlugin({
        sourceMap: false
    }))
    config.plugins.push(new ManifestPlugin())
}

module.exports = config