<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:output
            method="html"
            doctype-public="XSLT-compat"
            omit-xml-declaration="yes"
            encoding="UTF-8"
            indent="yes" />

    <xsl:param name="sortBy" select="'genre'" />
    <xsl:param name="order" select="'ascending'" />
    <xsl:param name="type" select="'text'" />

    <xsl:template match="/">
        <html>
            <head>
                <meta charset="utf-8" />
                <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                <meta name="viewport" content="width=device-width, initial-scale=1" />

                <title>Bibliothek</title>
                <!-- Bootstrap CSS -->
                <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
                <!-- Custom styles for this template -->
                <link href="bootstrap/css/starter-template.css" rel="stylesheet" />
            </head>
        <body>

            <nav class="navbar navbar-inverse navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <span class="sr-only">Toggle navigation</span>
                        </button>
                        <a class="navbar-brand" href="/">Bibliothek</a>
                    </div>
                    <div id="navbar" class="collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="/">List of Books</a></li>
                            <li><a href="#enter">Enter new Books</a></li>
                            <li><a href="#contact">Contact</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </nav>

            <div class="container">

                <div class="wrapper">
                    <h1>Entire List of our Books</h1>

                    <table class="table table-striped">

                        <tr>
                            <th><a href="/?sort=author">Author</a></th>
                            <th><a href="/?sort=title">Title</a></th>
                            <th><a href="/?sort=genre">Genre</a></th>
                            <th><a href="/?sort=number(price)?type=number">Price</a></th>
                            <th><a href="/?sort=publish_date">Publish Date</a></th>
                            <th><a href="/?sort=description">Description</a></th>
                        </tr>

                        <xsl:for-each select="catalog/book">

                            <xsl:sort select="*[name()=$sortBy]" order="{$order}" data-type="{$type}"/>

                            <tr>
                                <td>
                                    <xsl:value-of select="author"/>
                                </td>
                                <td>
                                    <xsl:value-of select="title"/>
                                </td>
                                <td>
                                    <xsl:value-of select="genre"/>
                                </td>
                                <td>
                                    <xsl:value-of select="price"/>
                                </td>
                                <td>
                                    <xsl:value-of select="publish_date"/>
                                </td>
                                <td>
                                    <xsl:value-of select="description"/>
                                </td>
                            </tr>
                        </xsl:for-each>

                </table>

                </div>

            </div><!-- /.container -->



        </body>
        </html>
    </xsl:template>

</xsl:stylesheet>
