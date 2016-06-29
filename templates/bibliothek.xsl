<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:output
            method="html"
            doctype-public="XSLT-compat"
            omit-xml-declaration="yes"
            encoding="UTF-8"
            indent="yes" />

    <xsl:include href="parameter.xsl" />
    <xsl:include href="header.xsl" />
    <xsl:include href="navigation.xsl" />

    <xsl:template match="/">
        <html>
            <xsl:call-template name="header"/>
        <body>
            <xsl:call-template name="navigation"/>

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
                                        <td><xsl:value-of select="author"/></td>
                                        <td><xsl:value-of select="title"/></td>
                                        <td><xsl:value-of select="genre"/></td>
                                        <td><xsl:value-of select="price"/></td>
                                        <td><xsl:value-of select="publish_date"/></td>
                                        <td><xsl:value-of select="description"/></td>
                                    </tr>
                                </xsl:for-each>
                            </xsl:when>
                            <xsl:otherwise>
                                <xsl:for-each select="//catalog/book">
                                    <xsl:sort select="*[name()=$sortBy]" order="{$order}" data-type="{$type}"/>
                                    <tr>
                                        <td><xsl:value-of select="author"/></td>
                                        <td><xsl:value-of select="title"/></td>
                                        <td><xsl:value-of select="genre"/></td>
                                        <td><xsl:value-of select="price"/></td>
                                        <td><xsl:value-of select="publish_date"/></td>
                                        <td><xsl:value-of select="description"/></td>
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
