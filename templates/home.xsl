<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:output
            method="html"
            doctype-public="XSLT-compat"
            omit-xml-declaration="yes"
            encoding="UTF-8"
            indent="yes" />

    <xsl:include href="header.xsl" />
    <xsl:include href="navigation.xsl" />
    <xsl:include href="js.xsl" />

    <xsl:template match="/">
        <html>
            <xsl:call-template name="header"/>
        <body>
            <xsl:call-template name="navigation"/>

            <div class="container">

                <div class="wrapper">
                    <h1>Welcome to our fantastic Bookstore</h1>
                </div>

            </div><!-- /.container -->

            <xsl:call-template name="js"/>
        </body>
        </html>
    </xsl:template>

</xsl:stylesheet>
