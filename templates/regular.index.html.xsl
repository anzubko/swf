<?xml version="1.0" encoding="utf-8" ?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:import href="regular.html.xsl" />

  <xsl:template match="/root" mode="title">
    <xsl:value-of select="registry/name" />
  </xsl:template>

  <xsl:template match="/root" mode="contents">
    <p>
      <xsl:value-of select="phrase" />
    </p>
  </xsl:template>

</xsl:stylesheet>
