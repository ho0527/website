package Net::DNS::RR::MR;

use strict;
use warnings;
our $VERSION = (qw$Id: MR.pm 1814 2020-10-14 21:49:16Z willem $)[2];

use base qw(Net::DNS::RR);


=head1 NAME

Net::DNS::RR::MR - DNS MR resource record

=cut

use integer;

use Net::DNS::DomainName;


sub _decode_rdata {			## decode rdata from wire-format octet string
	my $self = shift;

	$self->{newname} = Net::DNS::DomainName1035->decode(@_);
	return;
}


sub _encode_rdata {			## encode rdata as wire-format octet string
	my $self = shift;

	my $newname = $self->{newname} || return '';
	return $newname->encode(@_);
}


sub _format_rdata {			## format rdata portion of RR string.
	my $self = shift;

	my $newname = $self->{newname} || return '';
	return $newname->string;
}


sub _parse_rdata {			## populate RR from rdata in argument list
	my $self = shift;

	$self->newname(shift);
	return;
}


sub newname {
	my $self = shift;

	$self->{newname} = Net::DNS::DomainName1035->new(shift) if scalar @_;
	return $self->{newname} ? $self->{newname}->name : undef;
}


1;
__END__


=head1 SYNOPSIS

    use Net::DNS;
    $rr = Net::DNS::RR('name MR newname');

=head1 DESCRIPTION

Class for DNS Mail Rename (MR) resource records.

=head1 METHODS

The available methods are those inherited from the base class augmented
by the type-specific methods defined in this package.

Use of undocumented package features or direct access to internal data
structures is discouraged and could result in program termination or
other unpredictable behaviour.


=head2 newname

    $newname = $rr->newname;
    $rr->newname( $newname );

A domain name which specifies a mailbox which is the
proper rename of the specified mailbox.


=head1 COPYRIGHT

Copyright (c)1997 Michael Fuhr. 

All rights reserved.

Package template (c)2009,2012 O.M.Kolkman and R.W.Franks.


=head1 LICENSE

Permission to use, copy, modify, and distribute this software and its
documentation for any purpose and without fee is hereby granted, provided
that the above copyright notice appear in all copies and that both that
copyright notice and this permission notice appear in supporting
documentation, and that the name of the author not be used in advertising
or publicity pertaining to distribution of the software without specific
prior written permission.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
DEALINGS IN THE SOFTWARE.


=head1 SEE ALSO

L<perl>, L<Net::DNS>, L<Net::DNS::RR>, RFC1035 Section 3.3.8

=cut
