/**
 * Webpack configuration.
 */

const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");
const cssnano = require("cssnano");
const { CleanWebpackPlugin } = require("clean-webpack-plugin");
const TerserPlugin = require("terser-webpack-plugin");

// JS Directory path.
const JS_DIR = path.resolve(__dirname, "src/js");
const IMG_DIR = path.resolve(__dirname, "src/img");
const BUILD_DIR = path.resolve(__dirname, "build");

const entry = {
    main: JS_DIR + "/main.js",
    "editor-styles": path.resolve(__dirname, "src/sass/blocks/editor-styles.scss"),
};

const output = {
    path: BUILD_DIR,
    filename: "js/[name].js",
    chunkFilename: "css/[name].css",
};

const plugins = (argv) => [
    new CleanWebpackPlugin({
        cleanStaleWebpackAssets: "production" === argv.mode,
    }),

    new MiniCssExtractPlugin({
        filename: "css/[name].css",
    }),
];

const rules = [
    {
        test: /\.js$/,
        include: [JS_DIR],
        exclude: /node_modules/,
        use: "babel-loader",
    },
    {
        test: /\.scss$/,
        include: [path.resolve(__dirname, "src/sass")],
        exclude: /node_modules/,
        use: [
            {
                loader: MiniCssExtractPlugin.loader,
            },
            "css-loader",
            "sass-loader",
        ],
    },
    {
        test: /\.(ttf|otf|eot|svg|woff(2)?|jpg|png)(\?[a-z0-9]+)?$/,
        type: "asset/resource",
        include: [IMG_DIR],
        exclude: /node_modules/,
        use: {
            loader: "file-loader",
            options: {
                name: "img/[name].[ext]",
                publicPath: "production" === process.env.NODE_ENV ? "../" : "../",
            },
        },
    },
];

module.exports = (env, argv) => ({
    entry: entry,
    output: output,
    devtool: "source-map",
    module: {
        rules: rules,
    },
    optimization: {
        minimizer: [
            new CssMinimizerPlugin({
                minimizerOptions: {
                    processor: cssnano,
                },
            }),
            new TerserPlugin({
                terserOptions: {
                    compress: {},
                },
            }),
        ],
    },
    plugins: plugins(argv),
    externals: {
        jquery: "jQuery",
    },
    stats: {
        children: true,
    },
});
