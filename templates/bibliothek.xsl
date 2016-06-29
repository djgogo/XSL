<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:output
            method="html"
            doctype-public="XSLT-compat"
            omit-xml-declaration="yes"
            encoding="UTF-8"
            indent="yes" />

   <xsl:include href="parameter.xsl" />

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
                            <li class="active"><a href="/bibliothek.php">List of Books</a></li>
                            <li><a href="enterBooks.php">Enter new Books</a></li>
                            <li><a href="#contact">Contact</a></li>
                        </ul>
                        <form class="navbar-form navbar-right" action="/bibliothek.php" role="search">
                            <div class="form-group">
                                <input type="text" name="search" class="form-control" placeholder="Search" />
                            </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div><!--/.nav-collapse -->
                </div>
            </nav>

            <div class="container">

                <div class="wrapper">
                    <h1>List of our Books</h1>

                    <table class="table table-striped">

                        <tr>
                            <th><a href="/bibliothek.php?sort=author&amp;order={$order}">Author</a></th>
                            <th><a href="/bibliothek.php?sort=title&amp;order={$order}">Title</a></th>
                            <th><a href="/bibliothek.php?sort=genre&amp;order={$order}">Genre</a></th>
                            <th><a href="/bibliothek.php?sort=price&amp;type=number&amp;order={$order}">Price</a></th>
                            <th><a href="/bibliothek.php?sort=publish_date&amp;order={$order}">Publish Date</a></th>
                            <th><a href="/bibliothek.php?sort=description&amp;order={$order}">Description</a></th>
                        </tr>

                        <xsl:choose>
                            <xsl:when test="$search != ''">
                                <xsl:for-each select="//catalog/book[*[contains(.,$search)]]">
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
                            </xsl:when>
                            <xsl:otherwise>
                                <xsl:for-each select="//catalog/book">
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
                            </xsl:otherwise>
                        </xsl:choose>

                </table>

                </div>

            </div><!-- /.container -->

        </body>
        </html>
    </xsl:template>

</xsl:stylesheet>
